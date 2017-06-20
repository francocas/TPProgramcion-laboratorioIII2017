<?php 
require_once 'claseConsulta.php';
class MWInformes{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $hola = QueHago::LogIn($data['usuario'],$data['contrasena']);
        return $response->withJson($hola);
     }

     public function TraerTodosLosInformes($request, $response)
     {
        $data = $request->getParsedBody();
        $hola = QueHago::TraerTodosLosInformes();
     }
}
?>