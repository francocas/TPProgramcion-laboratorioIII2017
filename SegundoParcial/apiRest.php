<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require 'vendor/autoload.php';
    require 'usuarios.php';
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
    $app->group('/usuarios', function(){
        $this->get('/hola', \usuarios::class.':hola');
        $this->post('/LogIn', \usuarios::class. ':LogIn');
        $this->post('/CargarMedicamento', \usuarios::class. ':CargarMed');
        $this->get('/TraerMed', \usuarios::class .':TraerTodosLosMed');
        $this->delete('/BorrarMed/{id}', \usuarios::class. ':BorrarMed');
        $this->post('/ventaMed', \usuarios::class. ':venderMed');
        $this->get('/TraerMedPorId/{id}', \usuarios::class. ':TraerMedPorId');

    });
    $app->run();
    ?>