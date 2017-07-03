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
        $decodificado = '';
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado != null)
            {
                //QueHago::ContarOperaciones($decodificado->id);
                return $response->withJson(QueHago::Listar($data['libre']));
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

    public function Ingreso($request, $response, $args)
     {
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
            if($decodificado != null)
            {
                QueHago::ContarOperaciones($decodificado->id);
                QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto'], $data['modeloAuto'], $decodificado->UsuarioEmpleado);
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

     public function Salida($request, $response, $args)
     {
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
            if($decodificado != null)
            {
                QueHago::ContarOperaciones($decodificado->id);
                QueHago::Salida($data['idLugar'],$decodificado->UsuarioEmpleado);
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

     public function LugarMenosUsado($request, $response, $args)
     {
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
            if($decodificado != null and $decodificado->Nivel == 1)
            {
                return $response->withJson(QueHago::TraerLugarMenosUsado());
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

     public function LugarMasUsado($request, $response, $args)
     {
        $data = $request->getParsedBody();
        $decodificado = "";
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado != null and $decodificado->Nivel == 1)
            {
                return $response->withJson(QueHago::TraerLugarMasUsado());
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


     public function LugarSinUsar($request, $response, $args)
     {
        $data = $request->getParsedBody();
        $decodificado = "";
        try{
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado != null and $decodificado->Nivel == 1)
            {
                return $response->withJson(QueHago::TraerLugarSinUsar());
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e)
        {
            return $response->getBody()->write($e);
        }
     }

     public function TraerInformesPorFecha($request, $response, $args)
     {
        $data = $request->getParsedBody();
        $decodificado = "";
        try
        {
            $decodificado = autentificadorJwt::VerificarToken($data['token']);
        }
        catch(Exception $e)
        {
            return $response->getBody()->write('Token invalido');
        }
        try{
            if($decodificado != null )
            {
                return $response->withJson(QueHago::TraerInformesPorFecha($data['fecha1'], $data['fecha2']));
            }
            else
            {
                return $response->getBody()->write('No tenes permisos maquinola');
            }
        }
        catch(Exception $e)
        {
            return $response->getBody()->write("Error");
        }
     }
}


?>