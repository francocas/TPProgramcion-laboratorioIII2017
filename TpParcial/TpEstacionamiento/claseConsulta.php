<?php 
    require_once("conexion.php");
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
        var_dump($Auxiliar);
        return '';
    }

    public static function Ingreso($idLugar, $patenteAuto, $colorAuto, $modeloAuto)
    {
        $database = DataBase::Connect();
        $database->Query("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`UsuarioIngreso`,`UsuarioSalida`) VALUES ([$idLugar], ['$patenteAuto'],['$colorAuto'],['$modeloAuto'],['".date("j.G:i")."],[''],['ElQueSea'],[''])");           
        $Auxiliar = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 1 WHERE lugares.id = $idLugar");
    }
    public static function Salida($idLugar)
    {
            $database = DataBase::Connect();
        //$Auxiliar3 = $database->Query("SELECT `idInforme` FROM 'lugares' WHERE $idLugar == lugares.id AND lugares.FlagOcupado == 1 ");
        $Auxiliar = $database->Query("UPDATE`informes` SET `HorarioSalida` = ".date("j.G:i").", `UsuarioSalida`= 'ElQueSea' WHERE informes.UsuarioSalida = '' AND informes.idLugar = $idLugar ");
        $Auxiliar2 = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id == $idLugar");
    }

    public static function LogIn($usuario, $contrasena)
    {
            $database = DataBase::Connect();
        $aux = $database->Query("SELECT UsuarioEmpleado, Nivel FROM `Empleados` WHERE empleados.UsuarioEmpleado = '$usuario' AND `Contraseña` = '$contrasena' AND EmpleadoActivo = 1 AND Suspendido = 0" );
        return $aux;
    }
}
?>