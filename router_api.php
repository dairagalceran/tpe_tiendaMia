<?php

require_once 'libs/Router.php';
require_once 'api/apiCommentController.php';

$router = new Router();
$apiCommentController = new ApiCommentsController();
$router->addRoute('comments', 'POST', $apiCommentController, 'addComment');
$router->addRoute('comments/product/:ID', 'GET', $apiCommentController, 'getAllCommentsByProduct');
$router->addRoute('comments/:ID', 'GET', $apiCommentController, 'getCommentById');
$router->addRoute('comments/:ID', 'DELETE', $apiCommentController, 'removeComment');
                 
$resource = $_GET["resource"];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);


