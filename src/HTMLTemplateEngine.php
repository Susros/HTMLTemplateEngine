<?php

namespace HTMLTemplateEngine;

// Import dependencies
require_once("ErrorHandler.php");
require_once("HTMLTemplate.php");

/**
 *	HTMLTemplateEngine
 *
 *	@version 2.0.0
 *	@license MIT
 *	@copyright 2018 HTMLTemplateEngine
 *	@author Kelvin <contact@kelvinyin.com>
 */

class HTMLTemplateEngine {

	/**
	 *	@var String Templates directory
	 */
	public static $DIRECTORY = "";

	/**
	 *	@var HTMLTemplate Template contents
	 */
	private $htmlTemplate;

	/**
	 *	@var String Executed template
	 */
	private $executedTemplate;

	/**
	 *	This method get template file.
	 *
	 *	All templates files are stored in different folders, called package.
	 *	Package name is used to get the template file.
	 *
	 *	Syntax:
	 *		HTMLTemplateEngine::{PACKAGE_NAME}("{TEMPLATE_FILE}");
	 *
	 *	If package and template file do not exists, error will be reported.
	 *	Otherwise, the template file will be returned to be passed into constructor.
	 */ 
	public static function __callStatic($package, $args) {

		// Get trace error
		$trace = debug_backtrace();
		$trace = end($trace);

		// Get directory
		$dir = HTMLTemplateEngine::$DIRECTORY;
		$dir = rtrim($dir, "/");

		// Check if package exists
		if (file_exists($dir . "/" . $package) === false) {

			// Handle error
			$e = new ErrorHandler(ErrorHandler::FATAL_ERROR, "Call to undefined method HTMLTemplateEngine::{$package}()", $trace['file'], $trace['line']);
			$e->printError();

		}

		// Check if there is only one argument
		if (count($args) != 1) {

			// Handle error
			$e = new ErrorHandler(ErrorHandler::WARNING_ERROR, "HTMLTemplateEngine::{$package}() expects 1 parameters, " . count($args) . " passed", $trace['file'], $trace['line']);
			$e->printError();

		}

		// Template file
		$tpl = $dir . "/" . $package . "/" . $args[0];

		// Check template exists and return the template file
		if (file_exists($tpl . ".tpl")) {
			return $tpl . ".tpl";
		} else if (file_exists($tpl . ".html")) {
			return $tpl . ".html";
		} else {

			// Handle error
			$e = new ErrorHandler(ErrorHandler::FATAL_ERROR, "Template: {$args[0]} is not found in the package: {$package}", $trace['file'], $trace['line']);
			$e->printError();

		}

		return "";

	}

	/**
	 *	Constructor
	 *
	 *	This loads template file.
	 *
	 *	@param String $tplFile Template file.
	 */
	public function __construct($tplFile) {

		$this->executedTemplate = "";

		// Check if template exists
		if (file_exists($tplFile)) {
			$tpl = file_get_contents($tplFile);
			$this->htmlTemplate = new HTMLTemplate($tpl);
		} else {

			// Handle error
			$e = new ErrorHandler(ErrorHandler::FATAL_ERROR, "Failed to load template: {$tplFile}", $trace['file'], $trace['line']);
			$e->printError();

		}
	}

	/**
	 *	This method echo out the template 
	 */
	public function render() {

		if ($this->executedTemplate == "") {
			$this->htmlTemplate->execute();
			$this->executedTemplate = $this->htmlTemplate->getTemplate();
		}

		echo $this->executedTemplate;

	}

	/**
	 *	Convert this object to string
	 *
	 *	@return String Executed template
	 */
	public function __toString() {

		if ($this->executedTemplate == "") {
			$this->htmlTemplate->execute();
			$this->executedTemplate = $this->htmlTemplate->getTemplate();
		}

		return $this->executedTemplate;

	}

	/**
	 *	Setter template variables
	 */
	public function __set($var, $value) {

		$trace = debug_backtrace();
		$trace = end($trace);

		// Check if variable exists
		if ($this->htmlTemplate->varExists($var)) {

			$this->htmlTemplate->pushVar($var, $value);

		} else {

			// Handle error
			$e = new ErrorHandler(ErrorHandler::NOTICE_ERROR, "Undefined variable: {$var}", $trace['file'], $trace['line']);
			$e->printError();

		}

	}

}

?>