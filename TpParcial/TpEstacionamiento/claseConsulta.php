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
        $fecha = date('d-m-y');
        $horarioAccion = date("y/m/d-G:i");
        $database->QueryUpdate("INSERT INTO `informes` (`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`,`HorarioEntrada`,`HorarioSalida`,`Fecha`,`UsuarioIngreso`,`UsuarioSalida`) VALUES ($idLugar, '$patenteAuto','$colorAuto','$modeloAuto','$horarioAccion','','$fecha',' $nombreUsuario','')");           
        $Auxiliar = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 1 ,`PatenteAuto` = '$patenteAuto', `Usos` = Usos + 1 WHERE lugares.id = $idLugar");
    }
    public static function Salida($idLugar, $nombreUsuario)
    {
        $database = DataBase::Connect();
        $horarioAccion = date("y/m/d-G:i");
        $Auxiliar = $database->QueryUpdate("UPDATE `informes` SET `HorarioSalida` = '$horarioAccion', `UsuarioSalida`= '$nombreUsuario'  WHERE informes.UsuarioSalida = '' AND informes.idLugar = $idLugar ");
        $Auxiliar2 = $database->QueryUpdate("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id = $idLugar");
    }

    public static function LogIn($usuario, $contrasena)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT UsuarioEmpleado, Nivel, id FROM `empleados` WHERE empleados.UsuarioEmpleado = '$usuario' AND `Contraseña` = '$contrasena' AND EmpleadoActivo = 1 AND Suspendido = 0" );
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
        $aux = $database->Query("SELECT * FROM `empleados` WHERE $idEmpleado = empleados.id AND empleados.Suspendido =0");
        if($aux != null)
        {
            $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `Suspendido`= 1 WHERE $idEmpleado = empleados.id");
        }
        else
        {
            throw new Exception();
        }
    }

    public static function ReintegrarUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT * FROM `empleados` WHERE $idEmpleado = empleados.id AND empleados.Suspendido = 1");
        if($aux != null)
        {
            $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `Suspendido`= 0 WHERE $idEmpleado = empleados.id");
        }
        else
        {
            throw new Exception();
        }
    }

    public static function EcharUsuario($idEmpleado)
    {
        $database = DataBase::Connect();
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT * FROM `empleados` WHERE $idEmpleado = empleados.id AND empleados.EmpleadoActivo = 1");
        if($aux != null)
        {
            $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `EmpleadoActivo`= 0 WHERE $idEmpleado = empleados.id");    
        }
        else
        {
            throw new Exception();
        }
        
    }

    public static function RecontratarUsuario($idEmpleado)
    {
         $database = DataBase::Connect();
        $database = DataBase::Connect();
        $aux = $database->Query("SELECT * FROM `empleados` WHERE $idEmpleado = empleados.id AND empleados.EmpleadoActivo = 0");
        if($aux != null)
        {
            $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `EmpleadoActivo`= 1 WHERE $idEmpleado = empleados.id");    
        }
        else
        {
            throw new Exception();
        }
    }
    public static function TraerLugarMasUsado()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT id, Usos FROM `lugares` WHERE Usos = (SELECT MAX(Usos) FROM lugares WHERE 1)");    
        return $Auxiliar;
    }

    public static function TraerLugarMenosUsado()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT id, Usos FROM `lugares` WHERE Usos = (SELECT MIN(Usos) FROM lugares WHERE 1)");    
        return $Auxiliar;
    }

    public static function TraerLugarSinUsar()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT id FROM `lugares` WHERE Usos = 0");    
        return $Auxiliar;
    }

    public static function TraerIDUsuario($nick, $contrasena)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT id FROM `empleados` WHERE empleados.UsuarioEmpleado = '$nick' AND `Contraseña` = '$contrasena'");
        return $Auxiliar;
    }

    public static function AgregarLogeo($idEmpleado)
    {   
        $mes = date('m');
        $dia = date('d');
        $Hora = date('G:i');
        $horarioAccion = 'Mes:'.$mes.' Dia:'.$dia.' Hora:'.$Hora;
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("INSERT INTO `logdeconexiones`(`idUsuario`, `HoraDeLogeo`) VALUES ($idEmpleado,'$horarioAccion')");
    }

    public static function TraerTodosLosLogeos()
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM `logdeconexiones` WHERE 1");    
        return $Auxiliar;
    }

    public static function ContarOperaciones($idEmpleado)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->QueryUpdate("UPDATE `empleados` SET `CantOperaciones`= empleados.CantOperaciones + 1 WHERE $idEmpleado = empleados.id");    
    }

    public static function TraerInformesPorFecha($fecha1, $fecha2)
    {
        $database = DataBase::Connect();
        $Auxiliar = $database->Query("SELECT * FROM informes WHERE DATE(`Fecha`) BETWEEN '$fecha1' AND '$fecha2'");    
        return $Auxiliar;
    }
}
?>