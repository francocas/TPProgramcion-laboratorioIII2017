<?php 
require_once 'claseConsulta.php';
class MWLugares
{
    public function hola($request,$response) {
        //$name = $request->getAttribute('name');
        $response->getBody()->write("Hello, name");
        return $response;
    }
    public function Listar($request, $response, $args) {
        $hola = $request->getParsedBody();
        return $response->withJson(QueHago::Listar($hola['libre']));
    }

    public function Ingreso($request, $response, $args)
     {
        $data = $request->getParsedBody();
        QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto'], $data['modeloAuto']);
     }

     public function Salida($request, $response, $args)
     {
        $data = $request->getParsedBody();
        QueHago::Salida($data['idLugar']);
     }
}


?>