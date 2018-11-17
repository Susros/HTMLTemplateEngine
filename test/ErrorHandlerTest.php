<?php
include "../src/ErrorHandler.php";
use HTMLTemplateEngine\ErrorHandler;

test();

function test() {
	$trace = debug_backtrace();
	$trace = end($trace);

	$e = new ErrorHandler(ErrorHandler::FATAL_ERROR, "Testing error handler", $trace["file"], $trace["line"]);
	$e->printError();

	echo "bazinga";
}
?>