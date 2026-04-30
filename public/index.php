<?php

$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri === '' || $uri === 'login') {
    require_once '../controllers/LoginController.php';
    (new LoginController())->index();
}

if ($uri === 'technicien/dashboard') {
    require_once '../controllers/TechnicienController.php';
    (new TechnicienController())->dashboard();
}
