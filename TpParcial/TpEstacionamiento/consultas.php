<?php 
    require_once("conexion.php");
    $database = DataBase::Connect();
    $queHago = $_POST['queHacer'];

    switch($queHago)
    {
        case 'listar':
            $Auxiliar = $database->Query("SELECT * FROM 'lugares' WHERE lugares.FlagOcupado == 1");
            break;
        case 'ingreso':
            $Auxiliar = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 1,`PatenteAuto`=$_POST['Patente'],`ColorAuto`=$_POST['Color'],`ModeloAuto`=$_POST['Modelo'],`HorarioEntrada`="date("j.G:i")",`HorarioSalida`='' WHERE lugares.id == $_POST['id']");
            break;
        case 'salida':
            $Auxiliar = $database->Query("INSERT INTO `informes`(`idLugar`, `PatenteAuto`, `ColorAuto`, `ModeloAuto`, `HorarioEntrada`, `HorarioSalida`, `UsuarioIngreso`, `UsuarioSalida`) VALUES (lugares.id,lugares.PatenteAuto,lugares.ColorAuto,lugares.ModeloAuto,lugares.HorarioEntrada,"date("j.G:i")",[value-7],[value-8])");
            $Auxiliar2 = $database->Query("UPDATE `lugares` SET `FlagOcupado`= 0 WHERE lugares.id == $_POST['id']");
            break;
        case 'login':
            $Auxiliar = $database->Query("SELECT `Contraseña` FROM `Usuarios` WHERE Usuarios.UsuarioEmpleado == $_POST['Usuario']");
            if($Auxiliar == $_POST['Usuario'])
            {
                $retorno = 1;
                //FUNCION PARA LAS SESSIONES / COOKIES
            }
            break;
        case 'logout':
            //FUNCION PARA LAS SESSIONES / COOKIES
            break;

    }




?>