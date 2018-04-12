<?php
include 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new \Router\Router($uri);
if($result = $router->match()) {
    print "Match de la ruta " . $uri . " con ID: " . $result;
} else {
    print "Ruta '" . $uri . "' no válida";
}