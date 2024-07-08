<?php
require_once("../../modelo/conexion_db.php");
require_once("../../modelo/consultas.php");
require_once("../../controlador/mostrarE.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <button class="icon-btn"onclick="location.href='menu_turno.html'">
            <img src="../Multimedia/flecha.png" alt="Atrás" class="icon">
        </button>
        <button class="icon-btn">
            <img src="../Multimedia/icon_aprendiz.png" alt="Aprender" class="icon">
        </button>
    </header>
   <?php
        consultarTE();
   ?>
</body>
</html>