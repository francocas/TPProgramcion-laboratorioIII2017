<?php 
require_once 'claseConsulta.php';
    use \Firebase\JWT\JWT;

class MWUsuarios{
    public function LogIn ( $request, $response, $args){
        $data = $request->getParsedBody();
        $nickYNivel = QueHago::LogIn($data['usuario'],$data['contrasena']);
        $token = autentificadorJwt::CrearToken($nickYNivel,3600);
        //$token = 'altogato';
        //var_dump($nickYNivel);
        $arrayARetornar = array("Token" => $token, "Nick" => $nickYNivel[0]['UsuarioEmpleado'], "Nivel"=> $nickYNivel[0]['Nivel']);
        autentificadorJwt::VerificarToken($token);
        return $response->withJson($arrayARetornar);
     }

     public static function TraerTodosLosUsuarios($request, $response)
     {
        return $response->withJson(QueHago::TraerTodosLosUsuarios());
     }

     public function CargarFoto ( $request, $response, $args){
         
        $files = $request->getUploadedFiles();
        //move_uploaded_file($files['A']->file,"files/ignaAltoGato.jpg");
        $nuevaFoto = $files['A'];
        $oldName = $files['A']->getClientMediaType();
        $oldName = explode('/',$oldName);
        //$file = $_FILES['archivo']['name'];
        var_dump($nuevaFoto);
        $path='files/';
        $nuevaFoto->moveTo($path.'ignaSeLaCome'.'.'.$oldName[1]);

     }
     
}

?>