<?php
function consultarAU() {
    session_start(); // Inicia la sesión para obtener $_SESSION['id']
    
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $objConsultas = new Consultas();
        $result = $objConsultas->verAU($id); 
        
        if (!$result || empty($result)) {
            echo "<script>alert('No se encontraron asistencias para el usuario $id');</script>";
            echo "<script>location.href='Consultar_Asistencia.html';</script>"; 
        } else {
            // Calcular el total de horas
            $total_hours = count($result); // Cada registro cuenta como una hora
            
            echo '
                <div class="cnt1">
                    <h1>Asistencias</h1>
                    <div class="attendance-list1">';
            
            foreach ($result as $f) {
                echo '
                    <div class="attendance-item1"><b>Dia:</b> ' . htmlspecialchars($f['fecha']) . '<br> <b>Hora:</b> ' . htmlspecialchars($f['hora']) . '</div>
                ';
            }
            
            echo '
                    </div>
                    <div class="total-hours1">
                        <p>Total horas: ' . htmlspecialchars($total_hours) . ' Horas</p>
                    </div>
                </div>
            ';
        }
    } else {
        echo "<script>alert('Usuario no autenticado');</script>";
        echo "<script>location.href='Consultar_Asistencia.html';</script>"; 
    }
}
?>
