<?php
// Configuración para mostrar todos los errores (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function Asistencia() {
    $hoy = date('Y-m-d');
    $hora = isset($_POST['Hora']) ? htmlspecialchars($_POST['Hora'], ENT_QUOTES, 'UTF-8') : null;

    $objConsulta = new Consultas();
    try {
        $result = $objConsulta->verTurnoA($hoy, $hora);
    } catch (PDOException $e) {
        echo (['error' => 'Error en la consulta: ' . $e->getMessage()]);
        exit;
    }

    if (!$result || empty($result)) {
        echo 'No hay turnos el día de hoy en la hora seleccionada';
        exit;
    }

    foreach ($result as $f) {
        echo '
        <div class="card">
            <img src="placeholder.png" alt="">
            <div class="info">
                <div class="name">' . $f['nombre_usuario'] . '</div>
                <div class="role">' . $f['nombre_rol'] . '</div>
                <button class="delete" type="submit"><img src="../Multimedia/chulo.png" alt=""><b>SI</b></button>  
                <button class="delete" type="submit"><img src="../Multimedia/xpa.png" alt=""><b>NO</b></button> 
            </div>
        </div>';
    }
    
}

?>