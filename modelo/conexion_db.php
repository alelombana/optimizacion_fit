<?php
//  creamos calse para usar de objeto mas adelante
class Conexion{
    // las clases existen para agrupar una o muchas funciones
    public function get_conexion(){
        // creamos variables fijas para crear la conexion
        $user="root";
        $pass="";
        $host="localhost";
        $db="optimizacion_fit";
        // creamos la cadena de conexion
        $conexion = new PDO("mysql: host=$host; dbname=$db;", $user,$pass);
        return $conexion;

        
    }
}
?>