<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'claseConsulta.php';
require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
    });

    $app->post('/Listar', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $listaDeAutos = QueHago::Listar($data['libre']);
    //$response->getBody()->write("Hello, Hola mundo slim framework");
    return $response;
    });
     $app->post('/Ingreso', function (Request $request, Response $response)
     {
        $data = $request->getParsedBody();
        QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto']);
     }
    $app->post('/Salida', function (Request $request, Response $response)
     {
        $data = $request->getParsedBody();
        QueHago::Salida($data['idLugar']);
     }

     $app->post('/LogIn', function (Request $request, Response $response)
     {
        $data = $request->getParsedBody();
        QueHago::LogIn($data['usuario','contrasena']);
        return $response;
     }
$app->run(); 


?>