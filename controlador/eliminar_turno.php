<?php
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");

session_start(); // definimos la funcion para mantener el id de la cuenta iniciada
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $hoy = date('Y-m-d');
$obj= new consultas();
$result=$obj->eliminarT($id,$hoy);
    }

?>
