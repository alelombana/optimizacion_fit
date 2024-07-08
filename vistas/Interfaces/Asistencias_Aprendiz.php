<?php
require_once("../../modelo/conexion_db.php");
require_once("../../modelo/consultas.php");
require_once("../../controlador/ver_asistenciaU.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="cabecera">
        <button class="icon-btn1" onclick="location.href='Consultar_Asistencia.html'">
            <img src="../Multimedia/flecha.png" alt="Atrás" class="icon">
        </button>
        <button class="icon-btn1">
            <img src="../Multimedia/icon_aprendiz.png" alt="Aprender" class="icon">
        </button>
    </header>  
    <?php
     consultarAU();
    ?>
</body>
</html>
