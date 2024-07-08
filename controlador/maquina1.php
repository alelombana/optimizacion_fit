<?php
function cargarmaquina1($id_maquinas){
    $objConsultas = new Consultas();
    $result =  $objConsultas -> consultarmaquinas($id_maquinas);

    if(!isset($result)){
        echo "<h2>No hay maquinas en esta seccion</h2>";

    }
    else{
        foreach ($result as $f){
            echo'  <div class="container">
        <h1>'.$f['maq_nombre'].'</h1>
        <div class="info-box">
            <div class="info-item">
                <img class="icon" src="../Multimedia/alerta.png"></img>
                <p>'.$f['maq_descripcion'].'</p>
            </div>
            <div class="info-item">
                <img class="icono" src="../Multimedia/reloj_info.png"></img>
                <p>Tiempo mínimo '.$f['tmini'].' min.<br><br>No exceder los '.$f['tmax'].' min.</p>
                <br>
                <p>'.$f['maq_estado'].'</p>
            </div>
        </div>
    </div>
            ';
        }
    }


}

?>