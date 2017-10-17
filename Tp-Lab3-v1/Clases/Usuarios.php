<?php 
require_once("../DAO/InformesDAO.php");
require_once("../DAO/UsuariosDAO.php");
class Usuarios{
    
    public static function TraerTodosLosUsuarios($request, $response){
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
    }

    public static function TraerTodosLosLogeos($request, $response){
        $data = $request->getParsedBody();
        try{
             if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {   
                return $response->getBody()->write("Error, logeate y reintenta");
            }    
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
        
        if($decodificado->Nivel == 1)
        {
            return $response->withJson(QueHago::TraerTodosLosLogeos());
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e){
            return $response->getBody()->write("Error");
        }
        
    }

     public function AgregarEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
             if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {   
                return $response->getBody()->write("Error, logeate y reintenta");
            }       
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
        if($decodificado->Nivel == 1)
        {
            if(isset($data['UsuarioEmpleado']) && isset($data['Nombre']) && isset($data['Apellido']) && isset($data['Contrasena']) && isset($data['Nivel']) && isset($data['Activo']) && isset($data['Suspendido']) && $data['UsuarioEmpleado'] != '' && $data['Nombre'] != '' && $data['Apellido'] != ''  && $data['Contrasena'] != '' && $data['Nivel'] != '' && $data['Activo'] != '' && $data['Suspendido'] != '')
            {
                QueHago::AgregarUsuario($data['UsuarioEmpleado'],$data['Nombre'],$data['Apellido'],$data['Contrasena'],$data['Nivel'],$data['Activo'],$data['Suspendido']);
                return $response->getBody()->write('Todo piola');
            }
            else
            {
                return $response->getBody()->write("No cargaste algun/os Dato/s");
            }
        }
        else
        {
            return $response->getBody()->write('No tenes permisos maquinola');
        }
        }
        catch(Exception $e){
            return $response->getBody()->write("Error");
        }
     }

     public function SuspenderEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {   
                return $response->getBody()->write("Error, logeate y reintenta");
            }
                
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                if(isset($data['idEmpleado']) && $data['idEmpleado'] != '')
                {
                    QueHago::SuspenderUsuario($data['idEmpleado']);
                    return $response->getBody()->write('Empleado Suspendido');
                }
                else
                {
                   return $response->getBody()->write("No cargaste los datos");
                }
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e){
            return $response->getBody()->write('Error');
        }
     }

     public function ReintegrarEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {
                return $response->getBody()->write("Error, logeate y reintenta");
            }
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                if(isset($data['idEmpleado']) && $data['idEmpleado'] != '')
                {
                    QueHago::ReintegrarUsuario($data['idEmpleado']);
                    return $response->getBody()->write('Empleado Reincorporado');
                }
                else
                {
                    return $response->getBody()->write("No cargaste los datos");
                }
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e){
            return $response->getBody()->write("Error 3");
        }
     }

     public function EcharEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {
                return $response->getBody()->write("Error, logeate y reintenta");
            }
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                if(isset($data['idEmpleado']) && $data['idEmpleado'] != '')
                {
                    QueHago::EcharUsuario($data['idEmpleado']);
                    return $response->getBody()->write('Empleado Echado');
                }
                else
                {
                    return $response->getBody()->write("No cargaste los datos");
                }
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e){
            return $response->getBody()->write("Error 3");
        }
     }

     public function RecontratarEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            if(isset($data['token']) && $data['token'] != '')
            {
                $decodificado = autentificadorJwt::VerificarToken($data['token']);
            }
            else
            {
                return $response->getBody()->write("Error, logeate y reintenta");
            }
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                if(isset($data['idEmpleado']) && $data['idEmpleado'] != '')
                {
                    QueHago::RecontratarUsuario($data['idEmpleado']);
                    return $response->getBody()->write('Empleado Recontratado');
                }
                else
                {
                    return $response->getBody()->write("No cargaste los datos");
                }
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e){
            return $response->getBody()->write("Error 3");
        }
     }
}
?>