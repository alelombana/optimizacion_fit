<?php
// Dependencias de conexión
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");

// Configuración para mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); // definimos la funcion para mantener el id de la cuenta iniciada
$id = $_SESSION['id'];
$hoy = date('Y-m-d');
$hora=$_POST['Hora'];

$objConsulta= new consultas();
$result=$objConsulta->AgendarTurno($id,$hoy,$hora);
?>

