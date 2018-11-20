<p align="center">
	<img src="logo.png" width="450" alt="HTML Template Engine" />
</p>

HTMLTemplateEngine is an easy, simple and lightweight templating engine library for PHP.

# Requirement

PHP Version 5.3 or higher.

# Installation

HTMLTemplateEngine can be manually downloaded or cloned by using:

```
git clone git@github.com:Susros/HTMLTemplateEngine.git
```

# Templates

The extension of template files is either tpl or html. Template files are all organised in different folders called packages. In each package, there can be just template files or folders to organise or categorise template files. 

Here is an example of directory structure for templates:

```bash
├── View
│   ├── package1
│   │   ├── **/*.tpl
│   ├── package2
│   │   ├── **/*.tpl
└── └── **/*.tpl
```

### Template Variables

Template variable is the placeholder for the actual value. The default value can be assigned to the variable. If the default value is not declared, an empty string will be used as default value.

| Syntax  | Description |
| :-----  | :--------- |
| {$var}  | Variable without default value |
| {$var : "default value"} | Variable with default value |

Example:

```html
<p>Hello, {$name : "World"}</p>
<p>{$msg}</p>
```

### Template Function

Template functions are used to tell what actions does template engine need to do when the template is being executed. There are two functions supported.

#### dup

'**dup**' template function is used to tell template engine to duplicate the template after the values are assigned to variables of the template.

| Syntax  | Description |
| :-----  | :--------- |
| {#dup : [Template contents] ;}  | Duplicate the template contents |

For example:

```html
<select>
	{#dup : <option value="{$id}">{$name}</option> ;}
</select>
```

#### loop

'**loop**' template function is used to tell template engine to make an 'n' copies of templates.

| Syntax  | Description |
| :-----  | :--------- |
| {#loop(n) : [Template contents]}  | Make n copies of template contents |

For example:

```html
{#loop(5) : <p>{$greeting}</p> ;}
```

# Usage

First, include the HTMLTemplateEngine class file. HTMLTemplateEngine is using namespace HTMLTemplateEngine.

```php
require_once "path/to/HTMLTemplateEngine.php";
```

Before using HTMLTemplateEngine, please make sure to set the directory of template files. As default, it is set to the current directory of the application.

For example:

```php
HTMLTemplateEngine::$DIRECTORY = $_SERVER["DOCUMENT_ROOT"] . "/view";
```

Then, template files can be passed through HTMLTEmplateEngine object initiator:

```php
$myTemplate = new HTMLTemplateEngine("template_name.tpl");
```

You can get the template by calling package name as static method with the syntax: ```HTMLTemplateEngine::PACKAGE_NAME("TEMPLATE_NAME")```

For example, to get the template1.tpl from cat1 of package1 as shown in the example above in Templates section:

```php
$myTemplate = new HTMLTemplateEngine(HTMLTemplateEngine::package1("cat1/template1"));
```

Once the template engine has been initiated, you can now access template variables in template files just like accessing object's variables. Template variables can be assigned as single value or array.

If we look at the example from the Template Variables section above:

```php
$myTemplate->msg = "Good Morngin!";
```

The output of template will be:

```html
<p>Hello, World</p>
<p>Good Morning!</p>
```

The variable **$name** was not assigned. Therefore, default value "World" is used. The variable **$msg** is assigned with the value "Good Morngin!" and thus it is used. Otherwise, empty string will be used.

As for the template function '**dup**', it will automatically be recognised by HTMLTemplateEngine when the template is being executed with the variables values. Since we want to duplicate the template and assign with different values for each duplicated template, we need to use array in this case. For example, by using the dup template above:

```php
$myTemplate->name = array(“John”, “Will”, “Josh”, “Kelvin”);
$myTemplate->id = array(1,2,3,4);
```

The output will be:

```html
<select>
	<option value=“1”>John</option>
	<option value=“2”>Will</option>
	<option value=“3”>Josh</option>
	<option value=“4”>Kelvin</option>
</select>
```

Similar to '**dup**' template function, HTMLTemplateEngine will automatically recognise the function '**loop**'. It will generate the specified number of copies of the template. For example:

```php
$myTemplate->greeting = "Hello, World!";
```

The output will be:

```html
<p>Hello, World!</p> 
<p>Hello, World!</p> 
<p>Hello, World!</p> 
<p>Hello, World!</p> 
<p>Hello, World!</p> 
```
