<?php
// dependencias de conexion
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");

//variables de formulario
$id =$_POST['id_aprendiz'];
$nombre =$_POST['nombre'];
$apellido =$_POST['apellido'];
$edad =$_POST['edad'];
$centro =$_POST['centro'];
$ficha =$_POST['ficha'];
$correo =$_POST['correo'];
$clave =$_POST['clave'];
$rol=1;


// se crea el objeto apartir de la clase consulta 
// para enviar los datos a una funcion
$objc = new Consultas();
$result = $objc->registrarUsu($id,$nombre,$apellido,$edad,$centro,$ficha,$correo,$clave,$rol);

?>