<?php 
require_once("../conexion.php");
    class UsuariosDAO
    {
        public static function LogIn($usuario, $contrasena){
            $database = DataBase::Connect();
            $aux = $database->Query("SELECT UsuarioEmpleado, Nivel, id FROM `empleados` WHERE empleados.UsuarioEmpleado = '$usuario' AND `Contraseña` = '$contrasena' AND EmpleadoActivo = 1 AND Suspendido = 0" );
            return $aux;
        }

        public static function TraerTodosLosUsuarios(){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT * FROM `empleados` WHERE 1");
            return $Auxiliar;
        }

        public static function AgregarUsuario($UsuarioEmpleado,$Nombre,$Apellido,$contraseña,$nivel, $activo, $suspendido){
            $database = DataBase::Connect();
            $Auxiliar = $database->QueryUpdate("INSERT INTO `empleados`(`UsuarioEmpleado`, `Nombre`, `Apellido`, `Contraseña`, `Nivel`, `EmpleadoActivo`, `Suspendido`) VALUES ('$UsuarioEmpleado','$Nombre','$Apellido','$contraseña',$nivel,$activo,$suspendido)");
            //return $Auxiliar;
        }
    
        public static function SuspenderUsuario($idEmpleado){
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
    
        public static function ReintegrarUsuario($idEmpleado){
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
    
        public static function EcharUsuario($idEmpleado){
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
    
        public static function RecontratarUsuario($idEmpleado){
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

        public static function TraerIDUsuario($nick, $contrasena){
            $database = DataBase::Connect();
            $Auxiliar = $database->Query("SELECT id FROM `empleados` WHERE empleados.UsuarioEmpleado = '$nick' AND `Contraseña` = '$contrasena'");
            return $Auxiliar;
        }
    
    }
?>