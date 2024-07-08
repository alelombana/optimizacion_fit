<?php
function consultarTE() {
    session_start(); // definimos la funcion para mantener el id de la cuenta iniciada
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $hoy = date('Y-m-d'); // Obtén la fecha actual en formato 'YYYY-MM-DD'
        $objConsultas = new Consultas();
        $result = $objConsultas->consultarT($id,$hoy); // Modifica este método para aceptar la fecha como parámetro
       
        //usamos empty para verificar si $result tiene no tiene contenido 
        if (!$result || empty($result)) {
            echo "<script>alert('No se encontraron turnos agendados en el dia de hoy para este usuario');</script>";
            echo "<script>location.href='menu_turno.html';</script>"; 

        //si las condiciones de verificasion de contenido no tienen respuesta el programa seguira
        } else {
            echo '
                <div class="container-reg">
                    <form action="../../controlador/eliminar_turno.php" method="POST">
                        <h2>Elimina tu turno</h2>
                        
                        <select name="id_turno" class="input-field">
                            <option value="" disabled selected>Selecciona el turno ha eliminar</option>';
        //se utiliza foreach para transmitir las variables $result de la bd otorgandolas a las temporales $f 
                            foreach ($result as $f) {
                                echo '<option value="'.$f['id'].'" class="turno">Dia/'.$f['fecha'].'-Hora/'.$f['hora_inicio'].'</option>';
                            }
           

            echo '</select>
                    <button type="submit" class="submit-btn" >Eliminar tu Turno</button>
                    <button type="button" class="submit-btn1" onclick="location.href=\'menu_turno.html\'">Cancelar</button>
                </form>
            </div>
            ';
        }
    } else {
        echo "<script>alert('Usuario no autenticado');</script>";
        echo "<script>location.href='menu_turno.html';</script>"; 
    }
}
?>

