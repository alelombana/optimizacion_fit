<?php
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");



$nombre = $descripcion = $tiempo_min = $tiempo_max = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la máquina del formulario POST
    $maquina_id = isset($_POST['maquina_id']) ? intval($_POST['maquina_id']) : 0;

    if ($maquina_id > 0) {
        $sql = "SELECT * FROM maquinas WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $maquina_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $tiempo_min = $row['tiempo_min'];
            $tiempo_max = $row['tiempo_max'];
        } else {
            $mensaje = "No se encontró la máquina.";
        }
        $stmt->close();
    } else {
        $mensaje = "ID de máquina inválido.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Info Maquina</title>
</head>
<body>
    <header class="cocacola">
        <button class="icon-btn" onclick="location.href='Home_Aprendiz.html'">
            <img src="Multimedia/flecha.png" alt="Atrás" class="icon">
        </button>
        <button class="icon-btn2">
            <img src="Multimedia/icon_aprendiz.png" alt="Aprender" class="icon2">
        </button>
        <div class="fondoE"><img src="Multimedia/Home_img.jpg" alt=""></div>
    </header>

    <div class="container">
        <?php if (!empty($nombre)): ?>
            <h1><?php echo htmlspecialchars($nombre); ?></h1>
            <div class="info-box">
                <div class="info-item">
                    <img class="icon" src="Multimedia/alerta.png">
                    <p><?php echo htmlspecialchars($descripcion); ?></p>
                </div>
                <div class="info-item">
                    <img class="icono" src="Multimedia/reloj_info.png">
                    <p>Tiempo mínimo: <?php echo htmlspecialchars($tiempo_min); ?> min.<br><br>No exceder los <?php echo htmlspecialchars($tiempo_max); ?> min.</p>
                </div>
            </div>
        <?php else: ?>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
