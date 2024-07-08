<?php
require_once("../../modelo/conexion_db.php");
require_once("../../modelo/consultas.php");
require_once("../../controlador/Asistencia.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ins.css">
    <title>Asistencia</title>

</head>
<body>
<header>
        <button class="icon-btn"onclick="location.href='Home_instructor.html'">
            <img src="../Multimedia/flecha.png" alt="Atrás" class="icon">
        </button>
        <button class="icon-btn">
            <img src="../Multimedia/icon_aprendiz.png" alt="Aprender" class="icon">
        </button>
    </header>
    <div class="container-reg">
    
        <form action="" method="POST">
            <h2>Buscar turnos por hora</h2>
            <input type="time" name="Hora" placeholder="Elige la hora" required class="input-field">
            <button type="submit">Buscar</button> 
            <br>
            <br>
            <h2>Personas con un turno</h2>
            <div class="container2">
               <?php
               Asistencia();
               ?>    
                </div>
            </form>
    </div>
    
</body>
</html>