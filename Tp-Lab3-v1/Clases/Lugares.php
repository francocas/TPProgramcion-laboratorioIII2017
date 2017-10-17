<?php 
class Lugares{
    public function Listar($request, $response, $args){
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
            if($decodificado != null)
            {
                if(isset($data['libre']) && $data['libre'] != '')
                {
                    //QueHago::ContarOperaciones($decodificado->id);
                    return $response->withJson(QueHago::Listar($data['libre']));
                }
                else
                {   
                    return $response->getBody()->write("No ingresaste datos");
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

    public function Ingreso($request, $response, $args){

        $data = $request->getParsedBody();
        $decodificado = '';
        try
        {
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
        try
        {
            if($decodificado != null)
            {
                if(isset($data['idLugar']) && isset($data['patenteAuto']) && isset($data['colorAuto']) && isset($data['modeloAuto']) && $data['idLugar'] != '' && $data['patenteAuto'] != '' && $data['colorAuto'] != '' && $data['modeloAuto']!= '')
                {
                    QueHago::ContarOperaciones($decodificado->id);
                    QueHago::Ingreso($data['idLugar'],$data['patenteAuto'],$data['colorAuto'], $data['modeloAuto'], $decodificado->UsuarioEmpleado);
                }
                else
                {   
                    return $response->getBody()->write("No ingresaste datos");
                }   
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

     public function Salida($request, $response, $args){
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
            if($decodificado != null)
            {
                if(isset($data['idLugar']) && $data['idLugar'] != '')
                {
                    QueHago::ContarOperaciones($decodificado->id);
                    QueHago::Salida($data['idLugar'],$decodificado->UsuarioEmpleado);
                }
                else
                {   
                    return $response->getBody()->write("No ingresaste los datos");
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

     public function LugarMenosUsado($request, $response, $args){
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
            if($decodificado != null && $decodificado->Nivel == 1)
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

     public function LugarMasUsado($request, $response, $args){
        $data = $request->getParsedBody();
        $decodificado = "";
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

    public function LugarSinUsar($request, $response, $args){
       $data = $request->getParsedBody();
       $decodificado = "";
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
}
?>