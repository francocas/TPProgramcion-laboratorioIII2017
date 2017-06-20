<?php 
require_once 'claseConsulta.php';
class MWUsuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
        $token = autentificadorJwt::CrearToken($nickYNivel,3600);
        $arrayARetornar = array("Token" => $token, "Nick" => $nickYNivel['UsuarioEmpleado'], "Nivel"=> $nickYNivel['Nivel']);
        return $response->withJson($arrayARetornar);
     }

     public static function TraerTodosLosUsuarios($request, $response)
     {
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
     }
}

?>