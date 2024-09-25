<?php
// app/core/Router.php

include_once '../controllers/ProductController.php';
include_once '../views/View.php';

$controller = new ProductController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $controller->getById($_GET['id']);
        } else {
            $result = $controller->getAll();
        }
        View::render($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $result = $controller->create($data);
        View::render($result);
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $data = json_decode(file_get_contents("php://input"));
            $result = $controller->update($_GET['id'], $data);
            View::render($result);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $result = $controller->delete($_GET['id']);
            View::render($result);
        }
        break;

    default:
        View::render(json_encode(["message" => "Método no permitido"]));
        break;
}
?>