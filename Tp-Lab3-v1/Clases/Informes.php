<?php 
require_once("../DAO/InformesDAO.php");
require_once("autentificadorJwt.php");
    class Informes{
        public function TraerInformesPorFecha($request, $response, $args){
           $data = $request->getParsedBody();
           $decodificado = "";
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
           try{
               if($decodificado != null )
               {
                   if(isset($data['fecha1']) && isset($data['fecha2']) && $data['fecha1'] != '' && $data['fecha2'] != '')
                   {
                       return $response->withJson(QueHago::TraerInformesPorFecha($data['fecha1'], $data['fecha2']));
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
           catch(Exception $e)
           {
               return $response->getBody()->write("Error");
           }
        }

        public function TraerTodosLosInformes($request, $response){
           $data = $request->getParsedBody();
           $hola = QueHago::TraerTodosLosInformes();
        }
    }
?>