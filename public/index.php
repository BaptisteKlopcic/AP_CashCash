<?php
session_start();

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "../app/controllers/" . $controllerName . ".php";

if (!file_exists($controllerFile)) {
    die("Contrôleur introuvable : $controllerName");
}

require $controllerFile;

$ctrl = new $controllerName();

if (!method_exists($ctrl, $action)) {
    die("Action introuvable : $action");
}

$ctrl->$action();
