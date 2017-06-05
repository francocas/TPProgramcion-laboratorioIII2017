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
        $Auxiliar = $database->Query("SELECT * FROM 'lugares' WHERE lugares.FlagOcupado == ".$libre);
        return $Auxiliar;
    }

    public static function Ingreso($idLugar, $patenteAuto, $colorAuto, $modeloAuto)
    {
            
            $database->Query("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`UsuarioIngreso`,`UsuarioSalida`) VALUES $idLugar, $patenteAuto,$colorAuto,$modeloAuto,".date("j.G:i").",'','ElQueSea',''");

            $idInforme = $database->Query("SELECT 'idInforme' FROM `informes` WHERE 1");
            $idInforme2 = $idInforme[count($idInforme)];
            
            $Auxiliar = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 1, `PatenteAuto` = $patenteAuto `idInforme` = $idInforme 2 WHERE lugares.id == $_POST['id']");
    }
    public static function Salida($idLugar)
    {
        $Auxiliar3 = $database->Query("SELECT `idInforme` FROM 'lugares' WHERE $idLugar == lugares.id AND lugares.FlagOcupado == 1 ");
        $Auxiliar = $database->Query("UPDATE`informes` SET `HorarioSalida` = ".date("j.G:i").", `UsuarioSalida`= 'ElQueSea' WHERE $Auxiliar3 == informes.idInforme");
        $Auxiliar2 = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id == $idLugar");
    }

}
?>