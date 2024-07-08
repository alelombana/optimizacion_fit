<?php
require_once("../../modelo/conexion_db.php");
require_once("../../modelo/consultas.php");
require_once("../../controlador/maquina1.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Info maquinas</title>

</head>
<body>

    <header class="cocacola">
        <button class="icon-btn" onclick="location.href='Menu_maquinas.html'">
            <img src="../Multimedia/flecha.png" alt="Atrás" class="icon">
        </button>
       
        <button class="icon-btn2">
            <img src="../Multimedia/icon_aprendiz.png" alt="Aprender" class="icon2">
        </button>
        <div class="fondoE"><img src="../Multimedia/Home_img.jpg" alt=""></div>
    </header>
        <?php
            $id_maquinas=5;
            cargarmaquina1($id_maquinas);

        ?>
  
    
</body>
</html>
