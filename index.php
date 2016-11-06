<?php
define("DEFAULT_CONTROLLER", "Users");
define("DEFAULT_ACTION", "login");

function run() {
    
    if (!isset($_GET["controller"])) {
        $_GET["controller"] = DEFAULT_CONTROLLER; 
    }
    
    if (!isset($_GET["action"])) {
        $_GET["action"] = DEFAULT_ACTION;
    }
    
    $controller = loadController($_GET["controller"]);
    
    $actionName = $_GET["action"];
    $controller->$actionName();
}
 
function loadController($controllerName) {  
    $controllerClassName = getControllerClassName($controllerName);
  
    require_once(__DIR__."/controller/".$controllerClassName.".php");  
    return new $controllerClassName();
}
 
function getControllerClassName($controllerName) {
    return strToUpper(substr($controllerName, 0, 1)).substr($controllerName, 1)."_Controller";
}

run();
 
?>