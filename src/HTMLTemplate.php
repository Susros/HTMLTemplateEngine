<?php

namespace HTMLTemplateEngine;

// Import dependency
require_once("HTMLTemplateData.php");

/**
 *	HTMLTemplate
 *
 *	@version 2.0.0
 *
 *	@author Kelvin <contact@kelvinyin.com>
 */

class HTMLTemplate {
	
	/**
	 *	@var String Template content
	 */
	private $template;

	/**
	 *	@var HTMLTemplateData[] To store template data
	 */
	private $templateData;

	/**
	 *	@var Mix[] To store variables and values
	 */
	private $varVal;

	/**
	 *	Constructor
	 *
	 *	This constructor initialise template.
	 *
	 *	@param String $tpl Template content
	 */
	public function __construct($tpl) {
		$this->templateData = array();
		$this->varVal = array();

		// Make sure there is nothing after ';}'
		$chunk = explode(';}', $tpl);
		$this->template = implode(';}' . "\r\n", $chunk);

		// Start collecting template data
		$this->collectTemplateData();

	}

	/**
	 *	Push the variable and value
	 *
	 *	@param String $var Variable name
	 *	@param String $val Value for variable name
	 */
	public function pushVar($var, $val) {
		$this->varVal[$var] = $val;
	}

	/**
	 *	Check if variable exists in the template
	 *
	 *	@param String $var Variable name
	 *
	 *	@return boolean True if it does, false otherwise
	 */
	public function varExists($var) {
		return preg_match($this->varPattern($var), $this->template);
	}

	/**
	 *	Execute template
	 */
	public function execute() {

		// Get each template data
		foreach($this->templateData as $data) {

			// Perform template function
			switch($data->getFunction()) {
				case "dup":

					// To store all variables
					$varList = array();

					// Get template variables
					foreach($data->getVars() as $var => $val) {

						// Check if $var has value. Use default otherwise
						if (array_key_exists($var, $this->varVal)) {
							$val = $this->varVal[$var];
						}

						// Transform val to array if it is not array
						if (is_array($val) === false) {
							$val = array($val);
						}

						foreach($val as $k => $v) {
							$varList[$k][$var] = $v;
						}

					}

					// To store list of duplicated html
					$dupHtml = array();

					// Replace and dup
					foreach($varList as $k => $v) {
						$html = $data->getHtmlString();

						foreach ($v as $var => $val) {
							$html = preg_replace($this->varPattern($var), $val, $html);
						}

						$dupHtml[] = $html;
					}

					// Complete dup html string
					$dupHtmlString = implode("", $dupHtml);

					// dup the template
					$this->template = str_replace($data->getTemplateString(), $dupHtmlString, $this->template);

					break;

				case "loop":

					// loop the template
					$loopStr = "";

					for($i = 0; $i < $data->getLoopTime(); $i++) {
						$loopStr .= $data->getHtmlString();
					}

					// Replace each template variable with value
					foreach($data->getVars() as $var => $val) {

						// Check if $var has value. Use default otherwise.
						if (array_key_exists($var, $this->varVal)) {

							// Check if the var is array
							if (is_array($this->varVal[$var])) {
								$loopStr = preg_replace($this->varPattern($var), implode("", $this->varVal[$var]), $loopStr);
							} else {
								$loopStr = preg_replace($this->varPattern($var), $this->varVal[$var], $loopStr);
							}

						} else {
							$loopStr = preg_replace($this->varPattern($var), $val, $loopStr);
						}

					}

					$this->template = str_replace($data->getTemplateString(), $loopStr, $this->template);

					break;

				default:

					// Get html string
					$html = $data->getHtmlString();

					// Replace each template variable with value
					foreach($data->getVars() as $var => $val) {

						// Check if $var has value. Use default otherwise.
						if (array_key_exists($var, $this->varVal)) {

							// Check if the var is array
							if (is_array($this->varVal[$var])) {
								$html = preg_replace($this->varPattern($var), implode("", $this->varVal[$var]), $html);
							} else {
								$html = preg_replace($this->varPattern($var), $this->varVal[$var], $html);
							}

						} else {
							$html = preg_replace($this->varPattern($var), $val, $html);
						}

					}

					$this->template = str_replace($data->getTemplateString(), $html, $this->template);

					break;
			}

		}

	}

	/**
	 *	Get the template
	 *
	 *	@return String Template
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 *	Convert this object to string
	 *
	 *	@return String Template
	 */
	public function __toString() {
		return $this->template;
	}

	/**
	 *	Collect template data
	 */
	private function collectTemplateData() {
		
		// List of template strings
		$templateStrings = preg_grep($this->varPattern(), explode("\n", $this->template));

		// Get each template string
		foreach($templateStrings as $str) {

			// Matched values for function
			$funcMatches = array();

			// Create template data object
			$htmlTemplateData = new HTMLTemplateData();

			// Original template string
			$htmlTemplateData->setTemplateString($str);

			// Check if the template has 'loop' template function
			if (preg_match($this->funcLoopPattern(), $str, $funcMatches)) {

				// Add template function name
				$htmlTemplateData->setFunction("loop");

				// Add number of time to loop
				$htmlTemplateData->setLoopTime(intval($funcMatches[1]));

				// Add html string
				$htmlTemplateData->setHtmlString($funcMatches[2]);

			} 

			// Check if the template has 'dup' template function
			else if (preg_match($this->funcDupPattern(), $str, $funcMatches)) {

				// Add template function name
				$htmlTemplateData->setFunction("dup");

				// Add html string
				$htmlTemplateData->setHtmlString($funcMatches[1]);

			}

			// No template function
			else {
				// Add html string
				$htmlTemplateData->setHtmlString($str);
			}

			// Matched value for variables
			$varMatches = array();

			// Extract variables
			if (preg_match_all($this->varPattern(), $htmlTemplateData->getHtmlString(), $varMatches)) {

				// To store variables
				$vars = array();

				// Get variables and their default values
				foreach($varMatches[1] as $k => $v) {
					$vars[$v] = $varMatches[3][$k];
				}

				// Add to template data
				$htmlTemplateData->setVars($vars);
			}

			$this->templateData[] = $htmlTemplateData;

		}
	}
	

	/**
	 *	This get the variable pattern
	 *
	 *	@param String $var Variable name. Empty for default.
	 *
	 *	@return String Pattern string for variable
	 * 
	 */
	private function varPattern($var = "") {
		if ($var == "") {
			return '/\{\$([a-zA-Z_]+[a-zA-Z0-9_]*)(:\"([^\"\}]+)\")?\}/';
		}

		return '/\{\$('. $var .')(:\"([^\"\}]+)\")?\}/';
	}

	/**
	 *	This get the pattern of template function name: dup
	 *
	 *	@return String Pattern string for template function name: dup
	 */
	private function funcDupPattern() {
		return '/\{#dup:(.+);\}/';
	}

	/**
	 *	This get the pattern of template function name: loop
	 *
	 *	@return String Pattern string for template function name: loop
	 */
	private function funcLoopPattern() {
		return '/\{#loop\(([0-9]+)\):(.+);\}/';
	}

}

?>