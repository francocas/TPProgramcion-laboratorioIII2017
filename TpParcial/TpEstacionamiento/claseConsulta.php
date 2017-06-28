<?php 
    require_once("conexion.php");
    require_once("autentificadorJwt.php");
    $database = DataBase::Connect();
class QueHago
{
    private function __construct()
	{
    }
    
    public static function Listar($libre)
	{
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `lugares` WHERE lugares.FlagOcupado = $libre"   );
        return $Auxiliar;
    }

    public static function Ingreso($idLugar, $patenteAuto, $colorAuto, $modeloAuto)
    {
        $database = DataBase::Connect();
        $database->Query("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`UsuarioIngreso`,`UsuarioSalida`) VALUES ($idLugar, '$patenteAuto','$colorAuto','$modeloAuto','','','ElQueSea','')");           
        $Auxiliar = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 1 ,`PatenteAuto` = '$patenteAuto' WHERE lugares.id = $idLugar");
    }
    public static function Salida($idLugar)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("UPDATE `informes` SET `HorarioSalida` = '', `UsuarioSalida`= 'ElQueSea' WHERE informes.UsuarioSalida = '' AND informes.idLugar = $idLugar ");
        $Auxiliar2 = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id = $idLugar");
    }

    public static function LogIn($usuario, $contrasena)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT UsuarioEmpleado, Nivel FROM `Empleados` WHERE empleados.UsuarioEmpleado = '$usuario' AND `Contraseña` = '$contrasena' AND EmpleadoActivo = 1 AND Suspendido = 0" );
        return $aux;
    }

    public static function TraerTodosLosUsuarios()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `empleados` WHERE 1");
        return $Auxiliar;
    }

        public static function TraerTodosLosInformes()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `informes` WHERE 1");
        return $Auxiliar;
    }

    public static function AgregarUsuario($UsuarioEmpleado,$Nombre,$Apellido,$contraseña,$nivel, $activo, $suspendido)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("INSERT INTO `empleados`(`UsuarioEmpleado`, `Nombre`, `Apellido`, `Contraseña`, `Nivel`, `EmpleadoActivo`, `Suspendido`) VALUES ('$UsuarioEmpleado','$Nombre','$Apellido','$contraseña',$nivel,$activo,$suspendido)");
        //return $Auxiliar;
    }
}
?>