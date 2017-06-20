<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'claseConsulta.php';
require 'vendor/autoload.php';
$app = new \Slim\App;
$app->add(function($req, $res, $next){
        $response = $next($req, $res);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

    $app->get('/', function (Request $request, Response $response) {
        //$name = $request->getAttribute('name');
        $response->getBody()->write("Hello, name");
        return $response;
    });

    $app->post('/Listar', function (Request $request, Response $response) {
        $hola = $request->getParsedBody();
        return $response->withJson(QueHago::Listar($hola['libre']));
    });

     $app->post('/Ingreso', function (Request $request, Response $response)
     {
        $data = $request->getParsedBody();
        var_dump($data);
        //QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto']);
     });

    $app->post('/Salida', function (Request $request, Response $response)
     {
        $data = $request->getParsedBody();
        QueHago::Salida($data['idLugar']);
     });
     $app->post('/LogIn', function (Request $request, Response $response){
        $data = $request->getParsedBody();
        $hola = QueHago::LogIn($data['usuario'],$data['contrasena']);
        return $response->withJson($hola);
     });
     $app->run();
?>