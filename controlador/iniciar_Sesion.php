<?php
// Dependencias de conexión
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");

// Obtener los datos del formulario
$id = $_POST['id'];
$clave =$_POST['clave']; 

// Crear una instancia de la clase Consultas
$objc = new Consultas();

// Llamar al método IniciarSesion para verificar las credenciales del usuario
$result = $objc->IniciarSesion($id, $clave); 
?>
