<?php
include "../src/HTMLTemplateEngine.php";

HTMLTemplateEngine::setDIR("tpl/");

$header = new HTMLTemplateEngine(HTMLTemplateEngine::frame("myframe/header"));
$footer = new HTMLTemplateEngine(HTMLTemplateEngine::frame("myframe/footer"));

$message = new HTMLTemplateEngine();
$message->load(HTMLTemplateEngine::widget("message/message"));

$message->loop("currency_option", array(
	"currency_code" => "AUD",
	"currency_name" => "Australian Dollar"
));

$message->loop("currency_option", array(
	"currency_code" => "NZD",
	"currency_name" => "New Zealand Dollar"
));

$message->loop("currency_option", array(
	"currency_code" => "USD",
	"currency_name" => "United State Dollar"
));

$message->loop("currency_option", array(
	"currency_code" => "SGD",
	"currency_name" => "Singapore Dollar"
));

$header->title = "HTML Template Engine - Heaphex";

$header->render();
$message->render();
$footer->render();
?>