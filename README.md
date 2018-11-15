<p align="center">
	<img src="logo.png" width="150" alt="HTML Template Engine" />
</p>

# HTML Template Engine
HTMLTemplateEngine is a template engine that loads HTML templates with template variables. The template variables in html template can be assigned a value with HTMLTemplateEngine just like assigning normal object variables.

# Installation
Download or clone HTMLTemplateEngine.git:

```
git clone https://github.com/Heaphex/HTMLTemplateEngine.git
```

Then, get the HTMLTemplateEngine source code at src/HTMLTemplateEngine.php.

Copy the source code to your working folder or library folder.

# Requirement
PHP Version: PHP 5.3 or higher

# Usage
Create template folder for all template files.

Create category files in template folder to categorise all template files, such as: widget, frame, ui, etc.

Directory structure should look like:

```
- tpl/
|	- widget/
|	|	- form/
|	|	|	- login.tpl
|	|	|	- register.tpl
|	- frame/
|	|	- index/
|	|	|	- header.html
|	|	|	- footer.html
```

The template file extension can be either .html or .tpl.

In template file, the syntax for making a template variable is {$var}.

For example:

```html
<div class='div-class'>
	<p class='p-class'>{$msg}</p>
</div>
```

To loop the template, the syntax is {$loop:LOOP_NAME:<tag>$var</tag>}, where LOOP_NAME is the name for the loop template.

For example:

```html
<select>
	{$loop:currency_option:<option value='$currency_code'>$currency_name</option>}
</select>
```

Include HTMLTemplateEngine in your PHP file if you are not using autoload.

```php
include_once "path/to/HTMLTemplateEngine.php";
```

Before using the template engine, the directory of template folder need to be specified.

```php
HTMLTemplateEngine::setDir("path/to/tpl");
```

You can get the template easily by calling its category and name. The syntax to get the template is 

```
HTMLTemplate::CATEGORY_NAME("TEMPLATE_NAME");
```
The category name is dynamic. It is the category folder in template folder. It can be named anything.

For example, if you want to get login form template from widget:

```php
HTMLTemplateEngine::widget("form/login");
```

The template engine needs to be instantiated to load the template. The template can be loaded in instantiation.

For example, if you want to load login form template from widget.

```php
$loginForm = new HTMLTemplateEngine(HTMLTemplateEngine::widget("form/login"));
```

or, you can instantiate the template engine, then load it:

```php
$loginForm = new HTMLTemplateEngine();

// Load login form
$loginForm->load(HTMLTemplateEngine::widget("form/login"));
```
After loading the template, the template variables can be assigned. The syntax to assign template variable is 

```
$obj->var = "value";
```

For example,

```php
$loginForm->title = "Login Form";
$loginForm->msg = "Please enter your username and password correctly to log in.";
```

To assign loop template, use the method called loop(), which as 2 parameters: loop name, variables with values to be assigned.

```
$obj->loop("loop_name", array(
	"var1" => "value1",
	"var2" => "value2"
));
```

For example, as for the loop template example given above,

```php
$template->loop("currency_option", array(
	"currency_code" => "AUD",
	"currency_name" => "Australian Dollar"
));

$template->loop("currency_option", array(
	"currency_code" => "NZD",
	"currency_name" => "New Zealand Dollar"
));

$template->loop("currency_option", array(
	"currency_code" => "USD",
	"currency_name" => "United State Dollar"
));

$template->loop("currency_option", array(
	"currency_code" => "SGD",
	"currency_name" => "Singapore Dollar"
));
```

Then, to display the template, it needs to be rendered.

```php
$loginForm->render();
```

To get the raw HTML string of the template, you can just use the object variable.

```php
echo htmlspecialchars($loginForm);

// Or passing to functions
someFunction($loginForm);
```
