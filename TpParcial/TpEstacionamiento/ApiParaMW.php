<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'claseConsulta.php';
require 'vendor/autoload.php';
require 'MWLugares.php';
require 'MWUsuarios.php';
require 'MWInformes.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$app = new \Slim\App(["settings" => $config]);
$app->add(function($req, $res, $next){
        $response = $next($req, $res);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });
    $app->group('/lugares', function(){
            $this->get('/', \MWLugares::class.':hola');
            $this->post('/Listar', \MWLugares::class.':Listar');
            $this->post('/Ingreso', \MWLugares::class.':Ingreso');
            $this->post('/Salida', \MWLugares::class.':Salida');
    });

    $app->group('/usuarios', function(){
        $this->get('/', \MWLugares::class.':hola');
        $this->post('/LogIn', \MWUsuarios::class. ':LogIn');
        $this->get('/asd', \MWUsuarios::class. ':TraerTodosLosUsuarios');
     });
     $app->run();
?>
