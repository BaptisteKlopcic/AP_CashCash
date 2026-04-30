<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/' || $uri === '/login') {
    require_once "../app/controllers/LoginController.php";
    $controller = new LoginController();
    $controller->index();
}

if ($uri === '/login/verifier') {
    require_once "../app/controllers/LoginController.php";
    $controller = new LoginController();
    $controller->verifier();
}
