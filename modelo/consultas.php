<?php
 class Consultas {
    
    
    public function registrarUsu($id, $nombre, $apellido, $edad, $centro, $ficha, $correo, $clave, $rol) {
        $objconexion = new Conexion();
        $conexion = $objconexion->get_conexion();
    
        try {
            // Iniciar la transacción
            $conexion->beginTransaction();

              // Definir la consulta SQL para insertar en la tabla ficha
              $insertarFicha = "INSERT IGNORE INTO ficha(id_fic) VALUES(:ficha)";
              // Preparar la consulta
              $stmtFicha = $conexion->prepare($insertarFicha);
              // Convertir los argumentos en parámetros con bindParam
              $stmtFicha->bindParam(":ficha", $ficha);
              // Ejecutar la consulta
              $stmtFicha->execute();
    
            // Definir la consulta SQL para insertar en la tabla usuarios
            $insertarUsuario = "INSERT INTO usuarios(id_usu, nombre, apellido, centro,ficha, correo, id_rol, edad, clave)
                                VALUES(:id, :nombre, :apellido, :centro,:ficha, :correo, :rol, :edad, :clave)";
            // Preparar la consulta
            $stmtUsuario = $conexion->prepare($insertarUsuario);
            // Convertir los argumentos en parámetros con bindParam
            $stmtUsuario->bindParam(":id", $id);
            $stmtUsuario->bindParam(":nombre", $nombre);
            $stmtUsuario->bindParam(":apellido", $apellido);
            $stmtUsuario->bindParam(":centro", $centro);
            $stmtUsuario->bindParam(":ficha", $ficha);
            $stmtUsuario->bindParam(":correo", $correo);
            $stmtUsuario->bindParam(":rol", $rol);
            $stmtUsuario->bindParam(":edad", $edad);
            $stmtUsuario->bindParam(":clave", $clave);
            // Ejecutar la consulta
            $stmtUsuario->execute();
    
            // Confirmar la transacción
            $conexion->commit();
    
            echo '<script>alert("Su cuenta ha sido creada")</script>';
            echo "<script>location.href='../index.html'</script>";
        } catch (Exception $e) {
            // Si hay algún error, deshacer la transacción
            $conexion->rollBack();
            echo '<script>alert("Error al crear la cuenta: ' . $e->getMessage() . '")</script>';
            echo "<script>location.href='../index.html'</script>";
        }
    }
    
      

  
    public function IniciarSesion($id, $clave){
        $objc = new Conexion();
        $conexion = $objc->get_conexion();
        
        $consultar = "SELECT * FROM usuarios WHERE id_usu = :id";
        $result = $conexion->prepare($consultar);
        $result->bindparam(":id", $id);
        $result->execute();
        
        if($f = $result->fetch()){
            // Validamos clave
            if($clave == $f['clave']){
                // Variables de sesión
                session_start();
                $_SESSION['id'] = $f['id_usu'];
                $_SESSION['rol'] = $f['id_rol'];
                $_SESSION['autenticacion'] = "si";
                
                if($f['id_rol'] == 1){
                    echo "<script>alert('Bienvenido " . $id . "');</script>";
                    echo "<script>location.href='../vistas/interfaces/Home_Aprendiz.html';</script>";
                } elseif($f['id_rol'] == 2){
                    echo "<script>alert('Vamos a chambear');</script>";
                    echo "<script>location.href='../vistas/interfaces/Home_Instructor.html';</script>"; // Cambia la ruta según sea necesario
                } elseif($f['id_rol'] == 3){
                    echo "<script>alert('Vamos a chambear');</script>";
                    echo "<script>location.href='../vistas/interfaces/Home_Administrador.html';</script>"; // Cambia la ruta según sea necesario
                } else {
                    echo "<script>alert('Rol no reconocido');</script>";
                    echo "<script>location.href='../index.html';</script>"; // Cambia la ruta según sea necesario
                }
            } else {
                echo "<script>alert('La clave no coincide');</script>";
                echo "<script>location.href='../index.html';</script>"; // Cambia la ruta según sea necesario
            }
        } else {
            echo "<script>alert('El ID no se encuentra en la base de datos');</script>";
            echo "<script>location.href='../index.html';</script>"; // Cambia la ruta según sea necesario
        }
    }
    public function contarTurnos($hoy, $hora) {
        $objconexion = new Conexion();
        $conexion = $objconexion->get_conexion();
        $consultar = "SELECT COUNT(*) as count FROM turno WHERE fecha = :hoy AND hora_inicio = :hora";
        $result = $conexion->prepare($consultar);
        $result->bindParam(":hora", $hora);
        $result->bindParam(":hoy", $hoy);
        $result->execute();
    
         // Utilizamos el bucle WHILE para mostrar los registros de la base de datos
         while($resultado = $result->fetch()){
            $f[]= $resultado;
        }
        return $f;
    }
    
    public function AgendarTurno( $id,$hoy, $hora) {
        var_dump($id);
        $objconexion = new Conexion();
        $conexion = $objconexion->get_conexion();
        
        try {
            // Verificar si ya existen 15 turnos para la misma hora y fecha
            $consultar_turnos = "SELECT COUNT(*) as count FROM turno WHERE fecha = :hoy AND hora_inicio = :hora";
            $stmt_turnos = $conexion->prepare($consultar_turnos);
            $stmt_turnos->bindParam(":hoy", $hoy);
            $stmt_turnos->bindParam(":hora", $hora);
            $stmt_turnos->execute();
            
            // Obtener el resultado del conteo de turnos para esa hora
            $row_turnos = $stmt_turnos->fetch(PDO::FETCH_ASSOC);
            $count_turnos = $row_turnos['count'];
            
            // Verificar si se pueden registrar más turnos para esa hora
            if ($count_turnos < 15) {
                // Consultar si ya existe un turno para hoy y el usuario
                $consultar = "SELECT COUNT(*) as count FROM turno WHERE fecha = :hoy AND turno_usu = :id";
                $stmt_consultar = $conexion->prepare($consultar);
                $stmt_consultar->bindParam(":id", $id);
                $stmt_consultar->bindParam(":hoy", $hoy);
                $stmt_consultar->execute();
                
                // Obtener el resultado del conteo de turnos del usuario para hoy
                $row = $stmt_consultar->fetch(PDO::FETCH_ASSOC);
                $count = $row['count'];
                
                // Verificar si ya hay un turno registrado para hoy
                if ($count == 0) {
                    // No existe turno registrado, proceder con la inserción del turno
                    $insertar = "INSERT INTO turno (turno_usu, hora_inicio, fecha) VALUES (:id, :hora, :hoy)";
                    $stmt_insertar = $conexion->prepare($insertar);
                    $stmt_insertar->bindParam(":id", $id);
                    $stmt_insertar->bindParam(":hora", $hora);
                    $stmt_insertar->bindParam(":hoy", $hoy);
                    $stmt_insertar->execute();
                    
                    // Mensaje y redirección en JavaScript
                    echo '<script>alert("Su turno se ha registrado")</script>';
                    echo '<script>location.href="../vistas/interfaces/menu_turno.html"</script>';
                } else {
                    // Ya existe un turno registrado para hoy, mostrar mensaje de error
                    echo '<script>alert("Ya tienes un turno hoy, no puedes registrar más de un turno")</script>';
                    echo '<script>location.href="../vistas/interfaces/menu_turno.html"</script>';
                }
            } else {
                // Ya hay 15 turnos registrados para esta hora, mostrar mensaje de error
                echo '<script>alert("Ya se han registrado 15 turnos para esta hora, elija otro horario ")</script>';
                echo '<script>location.href="../vistas/interfaces/menu_turno.html"</script>';
            }
        } catch (PDOException $e) {
            // Capturar la excepción de PDO si ocurre algún error en la consulta o ejecución
            echo "Error: " . $e->getMessage();
        }
    }
    
    

       public function consultarmaquinas($id_maquinas){
        $f = null;
        // Creamos el objeto conexion a partir del objeto conexion
        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();
        // Realizamos la consulta correspondiente en mysql
        $consultar = "SELECT * FROM maquinas WHERE id_maq = :id_maquinas";
        $result = $conexion->prepare($consultar);
        $result->bindparam(":id_maquinas", $id_maquinas);
        // Ejecutamos la funcion
        $result->execute();

        // Utilizamos el bucle WHILE para mostrar los registros de la base de datos
        while($resultado = $result->fetch()){
            $f[]= $resultado;
        }
        return $f;

    }
      

    public function consultarT($id,$hoy){
        $f = null;
        // Creamos el objeto conexion a partir del objeto conexion
        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();
        // Realizamos la consulta correspondiente en mysql
        $consultar = "SELECT * FROM turno WHERE turno_usu = :id AND fecha= :hoy";
        $result = $conexion->prepare($consultar);
        $result->bindparam(":id", $id);
        $result->bindparam(":hoy", $hoy);
        // Ejecutamos la funcion
        $result->execute();

        // Utilizamos el bucle WHILE para mostrar los registros de la base de datos
        while($resultado = $result->fetch()){
            $f[]= $resultado;
        }
        return $f;

    }

    public function eliminarT($id,$hoy){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
            // Realiza la consulta para eliminar el turno
            $borrar = "DELETE FROM turno WHERE turno_usu = :id AND fecha= :hoy";
            $result = $conexion->prepare($borrar);
            $result->bindParam(":id", $id);
            $result->bindparam(":hoy", $hoy);
             $result->execute();
       
            echo'<script>alert("su turno se a eliminado")</script>';
            echo"<script>location.href='../vistas/interfaces/menu_turno.html'</script>";
    }
    public function verAU($id){

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $consultar="SELECT asis_turno, fecha, hora FROM asistencia WHERE aprendizT =:id";
        $result = $conexion->prepare($consultar);
        $result->bindParam(":id", $id);
         $result->execute();
          // Utilizamos el bucle WHILE para mostrar los registros de la base de datos
        while($resultado = $result->fetch()){
            $f[]= $resultado;
        }
        return $f;
    }




    
    //consultas instructor 
    public function verTurnoA($fecha, $hora = null) {
        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();
    
        try {
            if ($hora) {
                $consultar = "SELECT t.*, u.nombre AS nombre_usuario, r.rol AS nombre_rol 
                              FROM turno t
                              JOIN usuarios u ON t.turno_usu = u.id_usu
                              JOIN rol r ON u.id_rol = r.id_rol
                              WHERE t.fecha = :fecha AND t.hora_inicio = :hora";
                $result = $conexion->prepare($consultar);
                $result->bindParam(":fecha", $fecha);
                $result->bindParam(":hora", $hora);
            } else {
                $consultar = "SELECT t.*, u.nombre AS nombre_usuario, r.rol AS nombre_rol 
                              FROM turno t
                              JOIN usuarios u ON t.turno_usu = u.id_usu
                              JOIN rol r ON u.id_rol = r.id_rol
                              WHERE t.fecha = :fecha";
                $result = $conexion->prepare($consultar);
                $result->bindParam(":fecha", $fecha);
            }
    
            $result->execute();
    
            $turnos = [];
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $turnos[] = $row;
            }
    
            return $turnos;
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta de turnos: " . $e->getMessage());
        }
    }
    
    

       

   }     