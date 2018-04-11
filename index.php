<?php
include 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new \Router\Router($uri);