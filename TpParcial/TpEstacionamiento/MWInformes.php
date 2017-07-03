<?php 
require_once 'claseConsulta.php';
class MWInformes{
     public function TraerTodosLosInformes($request, $response)
     {
        $data = $request->getParsedBody();
        $hola = QueHago::TraerTodosLosInformes();
     }
}
?>