<?php
include "../src/HTMLTemplateEngine.php";

HTMLTemplateEngine::setDIR("tpl/");

$header = new HTMLTemplateEngine(HTMLTemplateEngine::frame("myframe/header"));
$footer = new HTMLTemplateEngine(HTMLTemplateEngine::frame("myframe/footer"));

$message = new HTMLTemplateEngine();
$message->load(HTMLTemplateEngine::widget("message/message"));
$message->msg = "Hello, World!";

$header->title = "HTML Template Engine - Heaphex";

$header->render();
$message->render();
$footer->render();
?>