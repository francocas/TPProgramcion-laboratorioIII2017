<?php 
require_once 'claseConsulta.php';
class MWUsuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $hola = QueHago::LogIn($data['usuario'],$data['contrasena']);
        return $response->withJson($hola);
     }

     public static function TraerTodosLosUsuarios($request, $response)
     {
        //$data = $request->getParsedBody();
        //$hola = QueHago::TraerTodosLosUsuarios();
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
     }
}

?>