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
	 *	Constructor
	 *
	 *	This constructor initiate all member variables
	 *
	 *	@param String   $_templateString
	 *	@param String   $_html
	 *	@param String[] $_vars
	 *	@param String   $_func
	 */
	public function __construct($_templateString = "", $_html = "", $_vars = "", $_func = "") {
		$this->templateString = $_templateString;
		$this->html 	   	  = $_html;
		$this->vars 		  = $_vars;
		$this->func 		  = $_func;
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
}

?>