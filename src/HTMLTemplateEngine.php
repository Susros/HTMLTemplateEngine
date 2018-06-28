<?php
/**
 *  HTML Template Engine
 *
 *  HTMLTemplateEngine loads HTML template with template variables and assign all
 *  those template variables with values specified.
 *
 *  @author Kelvin Yin <contact@kelvinyin.com>
 *  @version v1.0.0
 *  @since v1.0.0
 *  @copyright 2018 HTMLTemplateEngine
 *  @license MIT
 *
 *  Author website: https://www.kelvinyin.com
 */

class HTMLTemplateEngine {
    /**
     *  Public Static Member Variable
     */
    
    /**
     *  @var string Directory of template
     */
    public static $DIR = "";
    
    /**
     *  Private Member Variables
     */
    
    /**
     *  @var string HTML Template
     */
    private $template;
    
    /**
     *  Static Methods
     */
    
    /**
     *  Method: setDir
     *
     *  This method is to set the directory of template.
     *
     *  @param string Directory of template
     */
    public static function setDIR($dir) {
        // Standardise DIR
        if (strrpos($dir, "/") < (strlen($dir) - 1)) {
            $dir .= "/";
        }
        
        self::$DIR = strtolower($dir);
    }
    
    /**
     *  This method is to get the full directory of template 
     *  from different category.
     *  
     *  The syntax:
     *      HTMLTemplateEngine::{TEMPLATE_CATEGORY}("TEMPLATE")
     *
     *  If the template exists, the full directory of template will be
     *  returned.
     *  
     *  If the specified category does not exist, the error will be
     *  displaye.
     *
     *  @param string $args The template to be loaded.
     *
     *  @return string Full path to template
     */
    public static function __callStatic($cat, $args) {
        
        // Get category
        $cat = strtolower($cat);
        
        // Trace error
        $trace = debug_backtrace();
        $trace = $trace[count($trace) - 1];
        
        // Check if directory is set
        if (self::$DIR == "") {
            echo "<b>Warning:</b> Template Directory is not defined.<br>";
            die();
        }

        // Check if category exists
        if (file_exists(self::$DIR . $cat) === false) {
            echo "<b>Fatal error:</b> 
                 Uncaught Error: Call to undefined method HTMLTemplateEngine::{$cat}() 
                 in <b>{$trace['file']}</b> on line <b>{$trace['line']}</b><br>";
            
            die();
        }
        
        // Check the arguments
        if (count($args) != 1) {
            echo "<b>Warning:</b> HTMLTemplateEngine::{$cat}() expects 1 parameters, ".
                 count($args) . " given in {$trace['file']} on line <b>{$trace['line']}</b><br>";
           
            die();
        }
        
        // Check if the argument is array
        if (is_array($args[0]) === true) {
            echo "<b>Warning:</b> HTMLTemplateEngine::{$cat}() expects non-array argument".
                 " in {$trace['file']} on line <b>{$trace['line']}</b><br>";
           
            die();
        }
        
        // Template
        $temp = self::$DIR . $cat . "/" . $args[0];
        
        
        // Check if tempalte exists
        if (file_exists($temp . ".tpl") === false && file_exists($temp . ".html") === false) {
            echo "<b>Warning:</b> 
                 Template: {$args[0]} is not found as defined 
                 in <b>{$trace['file']}</b> on line <b>{$trace['line']}</b><br>";
            
            die();
        }
        
        // Get the template extension
        if (file_exists($temp . ".tpl") === true) {
            $temp .= ".tpl";
        } else {
            $temp .= ".html";
        }
        
        return $temp;
    }
    
    /**
     *  Member Methods
     */
    
    /**
     *  Constructor
     *
     *  The constructor accept one optional parameter argument
     *  for template.
     * 
     *  If parameter is not empty, the constructor will load
     *  the template to the engine.
     *
     *  @param string $temp The directory pathway to template.
     *                      Empty string as a default value.
     */
    public function __construct($temp = "") {
        
        // Chck if $temp is empty
        // Load the template if template is specified
        // Otherwise, initialise variable with empty string.
        
        if ($temp != "") {
            $this->load($temp);
        } else {
            $this->template = "test";
        }
    }
    
    /**
     *  Set template variable.
     *
     *  In template, the variable syntax is {$var}.
     *  To set the template variable: $example->var = "Example".
     */
    public function __set($var, $value) {
        
        // Check if value is array
        if (is_array($value) === true) {
            $value = implode(" ", $value);
        }
        
        $this->template = str_replace("{\${$var}}", $value, $this->template);
    }
    
    /**
     *  Get the template
     *
     *  This allow the template to pass from one to another without
     *  rendering.
     *
     *  @return string Template
     */
    public function __toString() {
        return preg_replace('/\{\$.*\}/', '', $this->template);
    }
    
    /**
     *  Method: load
     *
     *  This method is to load the template into the engine.
     *
     *  @param string $temp The directory pathway to template.
     */
    public function load($temp) {
        
        // Check if template exists,
        // Load template if exists,
        // Trigger error if template file doesn't exist.
        

        if (file_exists($temp) === true) {
            $this->template = file_get_contents($temp);
        } else {
            $this->printErrorMessage("Failed to load: {$temp}");
        }
    }
    
    /**
     *  Method: render
     *
     *  This method is to render the template on the screen.
     */
    public function render() {
        echo preg_replace('/\{\$.*\}/', '', $this->template);
    }
    
    /**
     *  Private Methods
     */
    
    /**
     *  Method: printErrorMessage
     *
     *  This method is used to print error message.
     *
     *  @param string $msg Error message
     */
    private function printErrorMessage($msg) {
        
        // Tracing error
        
        $trace = debug_backtrace();
        $trace = $trace[count($trace) - 1];

        echo "<b>Error:</b> {$msg} in <b>{$trace['file']}</b> on line <b>{$trace['line']}</b><br>";

        die();
    }
}

?>