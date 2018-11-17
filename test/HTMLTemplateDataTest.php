<?php

include "../src/HTMLTemplateData.php";
use HTMLTemplateEngine\HTMLTemplateData;

$d = new HTMLTemplateData('{#dup:<p>{$msg}</p>;}', '<p>{$msg}</p>', array("msg" => "hello"), "dup");

echo "Template String: " . htmlspecialchars($d->getTemplateString()) . "<br>";
echo "HTML String: " . htmlspecialchars($d->getHtmlString()) . "<br>";
echo "Variables: <pre>"; print_r($d->getVars()); echo "</pre><br>";
echo "Function Name: " . $d->getFunction() . "<br>";

?>