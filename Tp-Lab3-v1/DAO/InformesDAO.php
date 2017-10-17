<?php 
require_once("../conexion.php");
    class InformesDAO
    {
        public static function TraerTodosLosLogeos(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT * FROM `logdeconexiones` WHERE 1");    
            return $Auxiliar;
        }
    
        public static function ContarOperaciones($idEmpleado){
            $database = DataBase::Connect();
            $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `CantOperaciones`= empleados.CantOperaciones + 1 WHERE $idEmpleado = empleados.id");    
        }
    
        public static function TraerInformesPorFecha($fecha1, $fecha2){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT * FROM informes WHERE DATE(`Fecha`) BETWEEN '$fecha1' AND '$fecha2'");    
            return $Auxiliar;
        }

        public static function AgregarLogeo($idEmpleado){   
            $mes = date('m');
            $dia = date('d');
            $Hora = date('G:i');
            $horarioAccion = 'Mes:'.$mes.' Dia:'.$dia.' Hora:'.$Hora;
            $database = DataBase::Connect();
            $Auxiliar = $database->QueryUpdate("INSERT INTO `logdeconexiones`(`idUsuario`, `HoraDeLogeo`) VALUES ($idEmpleado,'$horarioAccion')");
        }
        
        public static function TraerTodosLosInformes(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT * FROM `informes` WHERE 1");
            return $Auxiliar;
        }
    }
?>