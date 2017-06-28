<?php 
require_once 'claseConsulta.php';
    use \Firebase\JWT\JWT;
class MWLugares
{
    public function hola($request,$response) {
        //$name = $request->getAttribute('name');
        $response->getBody()->write("Hello, name");
        return $response;
    }
    public function Listar($request, $response, $args) {
        $data = $request->getParsedBody();
        $decodificado = autentificadorJwt::VerificarToken($data['token']);
        if($decodificado != null)
        {
            return $response->withJson(QueHago::Listar($data['libre']));
        }
        else
        {
            echo('No tenes permisos maquinola');
        }
    }

    public function Ingreso($request, $response, $args)
     {
        $data = $request->getParsedBody();
        $decodificado = autentificadorJwt::VerificarToken($data['token']);
        //var_dump($decodificado);
        if($decodificado != null)
        {
            QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto'], $data['modeloAuto'], $decodificado->UsuarioEmpleado);
        }
        else
        {
            echo('No tenes permisos maquinola');
        }
        
     }

     public function Salida($request, $response, $args)
     {
        $data = $request->getParsedBody();
        $decodificado = autentificadorJwt::VerificarToken($data['token']);
        if($decodificado != null)
        {
            QueHago::Salida($data['idLugar'],$decodificado->UsuarioEmpleado);
        }
        else
        {
            echo('No tenes permisos maquinola');
        }
        
     }
}


?>