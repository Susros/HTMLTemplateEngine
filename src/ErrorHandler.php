<?php

namespace HTMLTemplateEngine;

/**
 *	ErrorHandler
 *
 *	@version 2.0.0
 *
 *	@author Kelvin <contact@kelvinyin.com>
 */

class ErrorHandler {
	
	/**
	 *	@var String Warning error type
	 */
	const WARNING_ERROR = "Warning";

	/**
	 *	@var String Fatal error type
	 */
	const FATAL_ERROR = "Fatal error";

	/**
	 *	@var String Notice error type
	 */
	const NOTICE_ERROR = "Notice";

	/**
	 *	@var String Error message
	 */
	private $errorMessage;

	/**
	 *	@var String Type of error
	 */
	private $errorType;

	/**
	 *	@var String File name where the error has been triggered
	 */
	private $filename;

	/**
	 *	@var int Line number where error has been triggered
	 */
	private $line;

	/**
	 *	Constructor
	 *
	 *	This constructor initiate all member variables
	 *
	 *	@param String $_errorType    Type of error
	 *	@param String $_errorMessage Error message to be printed
	 *	@param String $_filename     Name of file where error occurred
	 *	@param String $_line		 Line in file where error occurred
	 */
	public function __construct($_errorType = "", $_errorMessage = "", $_filename = "", $_line = "") {
		$this->errorType    = $_errorType;
		$this->errorMessage = $_errorMessage;
		$this->filename     = $_filename;
		$this->line         = $_line;
	}

	/**
	 *	Set the type of error
	 *
	 *	@param String $_errorType Type of error
	 */
	public function setErrorType($_errorType) {
		$this->errorType = $_errorType;
	}

	/**
	 *	Set error message
	 *
	 *	@param String $_errorMessage Error message to be printed
	 */
	public function setErrorMessage($_errorMessage) {
		$this->errorMessage = $_errorMessage;
	}

	/**
	 *	Set filename where error occurred
	 *
	 *	@param String $_filename Name of file where error occurred
	 */
	public function setFilename($_filename) {
		$this->filename = $_filename;
	}

	/**
	 *	Set line number in file where error occurred
	 *
	 *	@param int $_line Line number in file where error occurred
	 */
	public function setLineNumber($_line) {
		$this->line = $_line;
	}

	/**
	 *	Get the type of error
	 *
	 *	@return String Error type
	 */
	public function getErrorType() {
		return $this->errorType;
	}

	/**
	 *	Get the error message
	 *
	 *	@return String Error Message
	 */
	public function getErrorMessage() {
		return $this->errorMessage;
	}

	/**
	 *	Get file name where error occurred
	 *
	 *	@return String File name where error occurred
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 *	Get line number in the file where error has occurred
	 *
	 *	@return int Line number in the file where error occurred
	 */
	public function getLineNumber() {
		return $this->line;
	}

	/**
	 *	Print error
	 */
	public function printError() {
		echo "<b>" . $this->errorType . "</b>: " . $this->errorMessage;

		if ($this->filename != "") {
			echo " in " . $this->filename;
		}

		if ($this->line > 0) {
			echo " on line <b>" . $this->line . "</b>";
		}

		echo "<br>";

		// Stop execution if it is fatal error
		if ($this->errorType == ErrorHandler::FATAL_ERROR) {
			die();
		}
	}

}

?>