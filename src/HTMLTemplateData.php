<?php

namespace HTMLTemplateEngine;

/**
 *	HTMLTemplateData
 *
 *	@version 2.0.0
 *
 *	@author Kelvin <contact@kelvinyin.com>
 */

class HTMLTemplateData {
	
	/**
	 *	@var String Template string.
	 */
	private $templateString;

	/**
	 *	@var String HTML string.
	 */
	private $html;

	/**
	 *	@var String[] Variables in the template string
	 */
	private $vars;

	/**
	 *	@var String Template function name.
	 */
	private $func;

	/**
	 *	@var int Number time to loop
	 */
	private $loopTime;

	/**
	 *	Constructor
	 *
	 *	This constructor initiate all member variables
	 *
	 *	@param String   $_templateString
	 *	@param String   $_html
	 *	@param String[] $_vars
	 *	@param String   $_func
	 *	@param int 		$_loopTime;
	 */
	public function __construct($_templateString = "", $_html = "", $_vars = "", $_func = "", $_loopTime = 0) {
		$this->templateString = $_templateString;
		$this->html 	   	  = $_html;
		$this->vars 		  = $_vars;
		$this->func 		  = $_func;
		$this->loopTime 	  = $_loopTime;
	}

	/**
	 *	Set template string
	 *
	 *	@param String $_templateString
	 */
	public function setTemplateString($_templateString) {
		$this->templateString = $_templateString;
	}

	/**
	 *	Set html string
	 *
	 *	@param String $_html
	 */
	public function setHtmlString($_html) {
		$this->html = $_html;
	}

	/**
	 *	Set variables
	 *
	 *	@param String[] $_vars
	 */
	public function setVars($_vars) {
		$this->vars = $_vars;
	}

	/**
	 *	Set function name
	 *
	 *	@param String $_func
	 */
	public function setFunction($_func) {
		$this->func = $_func;
	}

	/**
	 *	Set number of time to loop
	 *
	 *	@param int $_loopTime
	 */
	public function setLoopTime($_loopTime) {
		$this->loopTime = $_loopTime;
	}

	/**
	 *	Get template string
	 *
	 *	@return String Template string
	 */
	public function getTemplateString() {
		return $this->templateString;
	}

	/**
	 *	Get html string
	 *
	 *	@return String Html string
	 */
	public function getHtmlString() {
		return $this->html;
	}

	/**
	 *	Get variables
	 *
	 *	@return String[] Variables
	 */
	public function getVars() {
		return $this->vars;
	}

	/**
	 *	Get function name
	 *
	 *	@return String Function name
	 */
	public function getFunction() {
		return $this->func;
	}

	/**
	 *	Get number of time to loop
	 *
	 *	@return int Number of time to loop
	 */
	public function getLoopTime() {
		return $this->loopTime;
	}
}

?>