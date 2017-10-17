<?php 
require_once("../DAO/InformesDAO.php");
require_once("../DAO/UsuariosDAO.php");
    class logInClass
    {
        public static function LogIn ( $request, $response, $args){
            $data = $request->getParsedBody();
            try{
                if(isset($data['usuario']) && isset($data['contrasena']) && $data['contrasena'] != '' && $data['usuario'] != '')
                {
                    $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
                    $idUsuario = QueHago::TraerIDUsuario($data['usuario'],$data['contrasena']);
                }
                else
                {
                    return $response->getBody()->write("No ingresaste datos");    
                }
            if($nickYNivel == null)
            {
                return $response->getBody()->write("Datos Invalidos");    
            }
            QueHago::AgregarLogeo($idUsuario[0]['id']);
            $token = autentificadorJwt::CrearToken($nickYNivel,3600);
            $arrayARetornar = array("Token" => $token, "Nick" => $nickYNivel[0]['UsuarioEmpleado'], "Nivel"=> $nickYNivel[0]['Nivel']);
            $decodificado = autentificadorJwt::VerificarToken($token);
            return $response->withJson($arrayARetornar);
            }
            catch(Exception $e)
            {
                return $response->getBody()->write("Error");
            }
        }

    }

?>