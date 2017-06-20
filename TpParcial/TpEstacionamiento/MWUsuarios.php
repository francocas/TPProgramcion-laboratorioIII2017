<?php 
require_once 'claseConsulta.php';
class MWUsuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
        $token = autentificadorJwt::CrearToken($nickYNivel,3600);
        //$token = 'altogato';
        //var_dump($nickYNivel);
        $arrayARetornar = array("Token" => $token, "Nick" => $nickYNivel[0]['UsuarioEmpleado'], "Nivel"=> $nickYNivel[0]['Nivel']);
        return $response->withJson($arrayARetornar);
     }

     public static function TraerTodosLosUsuarios($request, $response)
     {
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
     }
}

?>