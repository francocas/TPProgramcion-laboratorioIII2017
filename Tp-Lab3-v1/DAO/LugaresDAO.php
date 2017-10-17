<?php
require_once("../conexion.php");
    class LugaresDAO
    {
        public static function Listar($libre){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT * FROM `lugares` WHERE lugares.FlagOcupado = $libre"   );
            return $Auxiliar;
        }
    
        public static function Ingreso($idLugar, $patenteAuto, $colorAuto, $modeloAuto, $nombreUsuario){
            $database = DataBase::Connect();
            $fecha = date('d-m-y');
            $horarioAccion = date("y/m/d-G:i");
            $database->QueryUpdate("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`Fecha`,`UsuarioIngreso`,`UsuarioSalida`) VALUES ($idLugar, '$patenteAuto','$colorAuto','$modeloAuto','$horarioAccion','','$fecha',' $nombreUsuario','')");           
            $Auxiliar = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 1 ,`PatenteAuto` = '$patenteAuto', `Usos` = Usos + 1 WHERE lugares.id = $idLugar");
        }

        public static function Salida($idLugar, $nombreUsuario){
            $database = DataBase::Connect();
            $horarioAccion = date("y/m/d-G:i");
            $Auxiliar = $database->QueryUpdate("UPDATE `informes` SET `HorarioSalida` = '$horarioAccion', `UsuarioSalida`= '$nombreUsuario'  WHERE informes.UsuarioSalida = '' AND informes.idLugar = $idLugar ");
            $Auxiliar2 = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id = $idLugar");
        }

        public static function TraerLugarMasUsado(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT id, Usos FROM `lugares` WHERE Usos = (SELECT MAX(Usos) FROM lugares WHERE 1)");    
            return $Auxiliar;
        }
    
        public static function TraerLugarMenosUsado(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT id, Usos FROM `lugares` WHERE Usos = (SELECT MIN(Usos) FROM lugares WHERE 1)");    
            return $Auxiliar;
        }
    
        public static function TraerLugarSinUsar(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT id FROM `lugares` WHERE Usos = 0");    
            return $Auxiliar;
        }
    
    }
?>