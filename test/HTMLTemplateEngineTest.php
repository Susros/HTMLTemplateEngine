<?php
include "../src/HTMLTemplateEngine.php";

use HTMLTemplateEngine\HTMLTemplateEngine;

HTMLTemplateEngine::$DIRECTORY = $_SERVER["DOCUMENT_ROOT"] . "/Github/Susros/HTMLTemplateEngine/test/view";

$h = new HTMLTemplateEngine(HTMLTemplateEngine::packagetest("test"));

$h->done = "SUCCESS!!";
$h->description = "This is really fun to do.";
$h->val = array(1,2,3,4);
$h->op = array("one", "two", "three", "four");
$h->msg = "Hello, Kelvin";
$h->test = array("TESTING", "ARRAY");

echo "<pre>";
echo htmlspecialchars($h);
echo "</pre>";

$h->render();

?>