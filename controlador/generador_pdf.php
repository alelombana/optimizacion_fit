<?php
require_once("../modelo/conexion_db.php");
require_once("../modelo/consultas.php");
require('../vistas/fpdf/fpdf.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function generarAU() {
    session_start(); // Inicia la sesión para obtener $_SESSION['id']
    
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $objConsultas = new Consultas();
        $result = $objConsultas->verAU($id); 
        
        if (!$result || empty($result)) {
            echo "<script>alert('No se encontraron asistencias para el usuario $id');</script>";
            echo "<script>location.href='../vistas/interfaces/Consultar_Asistencia.html';</script>"; 
        } else {
            // Calcular el total de horas
            $total_hours = count($result); // Cada registro cuenta como una hora
            
            // Crear el PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Asistencias', 0, 1, 'C');
            $pdf->Ln(10);
            
            $pdf->SetFont('Arial', '', 12);
            foreach ($result as $f) {
                $pdf->Cell(0, 10, 'Dia: ' . htmlspecialchars($f['fecha']) . ' - Hora: ' . htmlspecialchars($f['hora']), 0, 1);
            }
            
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Total horas: ' . htmlspecialchars($total_hours) . ' Horas', 0, 1);

            // Descargar el PDF
            $pdf->Output('D', 'Asistencias.pdf');
        }
    } else {
        echo "<script>alert('Usuario no autenticado');</script>";
        echo "<script>location.href='Consultar_Asistencia.html';</script>"; 
    }
}

// Llamar a la función para generar el PDF
generarAU();
?>
