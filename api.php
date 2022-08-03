<?php
$conexion = new PDO('mysql:host=localhost;dbname=abi', 'root', '');

//si hay peticion post

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $fecha_nac = $_POST['fecha_nac'];
    $fecha_insc = $_POST['fecha_insc'];
    $costo = $_POST['costo'];

    $sql = "INSERT INTO inscripciones (nombre, edad, fecha_nacimiento, fecha_inscripcion, costo) VALUES ('$nombre', '$edad', '$fecha_nac', '$fecha_insc', '$costo')";
    $conexion->exec($sql);
    $id = $conexion->lastInsertId();

    echo $id;


}
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if($_GET['accion']=='todos'){
        $sql = "SELECT * FROM inscripciones";
        $resultado = $conexion->query($sql);
        $inscripciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($inscripciones);
    }
    if($_GET['accion']=='uno'){
        $id = $_GET['id'];
        $sql = "SELECT * FROM inscripciones WHERE id = '$id'";
        $resultado = $conexion->query($sql);
        $inscripcion = $resultado->fetch(PDO::FETCH_ASSOC);
        echo json_encode($inscripcion);
    }

}
// delete
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $id = $_GET['id'];
    $sql = "DELETE FROM inscripciones WHERE id = $id";
    $conexion->exec($sql);
}
// update

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    
    $datos = json_decode(file_get_contents("php://input"));
    $id = $datos->id;
    $nombre = $datos->nombre;
    $edad = $datos->edad;
    $fecha_nac = $datos->fecha_nac;
    $fecha_insc = $datos->fecha_insc;
    $costo = $datos->costo;

    // $id = $_GET['id'];
    // $nombre = $_GET['nombre'];
    // $edad = $_GET['edad'];
    // $fecha_nac = $_GET['fecha_nac'];
    // $fecha_insc = $_GET['fecha_insc'];
    // $costo = $_GET['costo'];

    $sql = "UPDATE inscripciones SET nombre = '$nombre', edad = '$edad', fecha_nacimiento = '$fecha_nac', fecha_inscripcion = '$fecha_insc', costo = '$costo' WHERE id = $id";
    $conexion->exec($sql);
}


?>