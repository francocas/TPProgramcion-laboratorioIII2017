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

    public static function Ingreso($idLugar, $patenteAuto, $colorAuto, $modeloAuto, $nombreUsuario)
    {
        $database = DataBase::Connect();
        $horarioAccion = date("m:j:G:i");
        $database->QueryUpdate("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`UsuarioIngreso`,`UsuarioSalida`) VALUES ($idLugar, '$patenteAuto','$colorAuto','$modeloAuto','$horarioAccion','',' $nombreUsuario','')");           
        $Auxiliar = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 1 ,`PatenteAuto` = '$patenteAuto' WHERE lugares.id = $idLugar");
    }
    public static function Salida($idLugar, $nombreUsuario)
    {
        $database = DataBase::Connect();
        $horarioAccion = date("m:j:G:i");
        $Auxiliar = $database->QueryUpdate("UPDATE `informes` SET `HorarioSalida` = '$horarioAccion', `UsuarioSalida`= '$nombreUsuario' WHERE informes.UsuarioSalida = '' AND informes.idLugar = $idLugar ");
        $Auxiliar2 = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id = $idLugar");
    }

    public static function LogIn($usuario, $contrasena)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT UsuarioEmpleado, Nivel FROM `empleados` WHERE empleados.UsuarioEmpleado = '$usuario' AND `Contraseña` = '$contrasena' AND EmpleadoActivo = 1 AND Suspendido = 0" );
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
        $Auxiliar = $database->QueryUpdate("INSERT INTO `empleados`(`UsuarioEmpleado`, `Nombre`, `Apellido`, `Contraseña`, `Nivel`, `EmpleadoActivo`, `Suspendido`) VALUES ('$UsuarioEmpleado','$Nombre','$Apellido','$contraseña',$nivel,$activo,$suspendido)");
        //return $Auxiliar;
    }

    public static function SuspenderUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `Suspendido`= 1 WHERE $idEmpleado = empleados.id");    
    }

    public static function ReintegrarUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `Suspendido`= 0 WHERE $idEmpleado = empleados.id");    
    }

    public static function EcharUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `EmpleadoActivo`= 0 WHERE $idEmpleado = empleados.id");    
    }

    public static function RecontratarUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `EmpleadoActivo`= 1 WHERE $idEmpleado = empleados.id");    
    }
}
?>