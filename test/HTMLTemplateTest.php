<?php

include "../src/HTMLTemplate.php";
use HTMLTemplateEngine\HTMLTemplate;

$tpl = file_get_contents("test.tpl");

$t = new HTMLTemplate($tpl);

$t->pushVar("done", "SUCCESS");
$t->pushVar("description", "Small description make things a lot difficult.");
$t->pushVar("val", array(1, 2, 3, 4));
$t->pushVar("op", array("one", "two", "three", "four"));
$t->execute();

echo "<pre>" . htmlspecialchars($t) . "</pre>";



// Debug
/*foreach($this->templateData as $v) {
	echo "<b>Template String:</b>". htmlspecialchars($v->getTemplateString()) . "<br>";
	echo "<b>HTML String:</b>". htmlspecialchars($v->getHtmlString()) . "<br>";
	echo "<b>Function:</b>" . $v->getFunction() . "<br>";
	echo "<b>Loop Time:</b>" . $v->getLoopTime() . "<br>";
	echo "<b>Variables:</b>";
	echo "<pre>"; print_r($v->getVars()); echo "</pre>";
	echo "<hr>";
} */

?>