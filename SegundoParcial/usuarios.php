<?php 
require_once 'claseConsulta.php';
    use \Firebase\JWT\JWT;

class usuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
        if($nickYNivel == null)
        {
            echo("Error");
            return $response;
        }
        $token = autentificadorJwt::CrearToken($nickYNivel,3600);
        //$token = 'altogato';
        //var_dump($nickYNivel);
        $arrayARetornar = array("Token" => $token);
        if(autentificadorJwt::VerificarToken($token)){
            echo("Usuario Verificado");
        }
        return $response->withJson($arrayARetornar);
     }
     public function CargarMed( $request, $response, $args){
         $data = $request->getParsedBody();
         QueHago::CargarMed($data['laboratorio'],$data['nombre'], $data['precio']);
     }
     
    public function TraerTodosLosMed($request, $response)
     {
         $meds = QueHago::TraerTodosLosMed();
         //var_dump($meds);
        return $response->withJson($meds);
     }

     public function BorrarMed ($request, $response, $args){
         $id = $args['id'];
         QueHago::BorrarMed($id);
     }
    public function venderMed ($request, $response, $args){
          $files = $request->getUploadedFiles();
          $data = $request->getParsedBody();
          $nuevaFoto = $files['foto'];
          $oldName = $files['foto']->getClientMediaType();
          $oldName = explode('/',$oldName);
          $nuevoNombre = QueHago::traerNombreYLab($data['id']);
          //var_dump($nuevoNombre);
          $path='files/';
          $cliente = $data['cliente'];
          $direccion = $nuevoNombre[0]['id'].'-'.$nuevoNombre[0]['laboratorio'].'.'.$oldName[1];
          $nuevaFoto->moveTo($path . $direccion);
          QueHago::cargarVenta($nuevoNombre[0]['id'],$cliente, $direccion);
      }
      
        public function hola($request,$response) {
        //$name = $request->getAttribute('name');
        $response->getBody()->write("Hello, name");
        return $response;
    }
    public function TraerMedPorId ($request, $response, $args){
         $id = $args['id'];
         $meds = QueHago::TraerMedPorId($id);
         return $response->withJson($meds);
     }

}
