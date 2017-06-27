<?php 
    require_once("conexion.php");
    require_once("autentificadorJwt.php");
    $database = DataBase::Connect();
class QueHago
{
    private function __construct()
	{
    }
    
    public static function LogIn($usuario, $contrasena)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT nombre FROM `usuarios` WHERE usuarios.nombre = '$usuario' AND `contraseña` = '$contrasena'" );
        
        return $aux;
    }

    public static function CargarMed($laboratorio, $nombre, $precio)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("INSERT INTO `medicamentos`(`laboratorio`, `nombre`, `precio`) VALUES ('$laboratorio','$nombre',$precio)");
    }

    public static function TraerTodosLosMed()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `medicamentos` WHERE 1");
        return $Auxiliar;
    }

    public static function BorrarMed($id)
    {
        $database = DataBase::Connect();
        $database->Query("DELETE FROM `medicamentos` WHERE medicamentos.id = $id");
    }
    public static function traerNombreYLab($id)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT `id`, `laboratorio` FROM `medicamentos` WHERE medicamentos.id = $id");
        return $Auxiliar;
    }

        public static function TraerMedPorId($id)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `medicamentos` WHERE medicamentos.id = $id");
        return $Auxiliar;
    }

    public static function cargarVenta($idMed,$nombreCliente,$foto)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("INSERT INTO `venta`( `idMed`, `nombreCliente`, `foto`) VALUES ($idMed,'$nombreCliente','$foto')");
        return $Auxiliar;
    }


}
?>