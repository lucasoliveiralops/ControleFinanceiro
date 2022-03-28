<?php
session_start();
date_default_timezone_set("America/Sao_Paulo");

if ($_SERVER['HTTP_HOST'] == 'localhost') {
  define('ENVIRONMENT', 'DEVELOPMENT');
  $urlBase = explode('/', $_SERVER['REQUEST_URI'])[2];
  define('URL_BASE', 'localhost/ControleFinanceiro/');
  define('DIR_APP', '/ControleFinanceiro/App/');
} else {
  define('ENVIRONMENT', 'PRODUCTION');
  define('URL_BASE', 'teste.com.br');
}
define('NAMESPACE_BASE', 'App\\');
define('NAME_APP', 'App');
require_once "vendor/autoload.php";
$routes = new \App\Routes\Route($urlBase);
