<?php 
require_once 'claseConsulta.php';
    use \Firebase\JWT\JWT;

class MWUsuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        try{
        $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
        $idUsuario = QueHago::TraerIDUsuario($data['usuario'],$data['contrasena']);
        if($nickYNivel == null)
        {
            return $response->getBody()->write("Error");    
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

     public static function TraerTodosLosUsuarios($request, $response)
    {
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
    }
    public static function TraerTodosLosLogeos($request, $response)
    {
        $data = $request->getParsedBody();
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
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
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
        if($decodificado->Nivel == 1)
        {
            QueHago::AgregarUsuario($data['UsuarioEmpleado'],$data['Nombre'],$data['Apellido'],$data['Contrasena'],$data['Nivel'],$data['Activo'],$data['Suspendido']);
            return $response->getBody()->write('Todo piola');
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
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                QueHago::SuspenderUsuario($data['idEmpleado']);
                return $response->getBody()->write('Empleado Suspendido');
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
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                QueHago::ReintegrarUsuario($data['idEmpleado']);
                return $response->getBody()->write('Empleado Reincorporado');
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

     public function EcharEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                QueHago::EcharUsuario($data['idEmpleado']);
                return $response->getBody()->write('Empleado Echado');
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

     public function RecontratarEmpleado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = '';
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado->Nivel == 1)
            {
                QueHago::RecontratarUsuario($data['idEmpleado']);
                return $response->getBody()->write('Empleado Recontratado');
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

    /* public function CargarFoto ( $request, $response, $args){
         
        $files = $request->getUploadedFiles();
        //move_uploaded_file($files['A']->file,"files/ignaAltoGato.jpg");
        $nuevaFoto = $files['A'];
        $oldName = $files['A']->getClientMediaType();
        $oldName = explode('/',$oldName);
        //$file = $_FILES['archivo']['name'];
        var_dump($nuevaFoto);
        $path='files/';
        $nuevaFoto->moveTo($path.'asd'.'.'.$oldName[1]);

     }*/
     
}

?>