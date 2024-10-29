<?php
require_once 'conexion.php';
require_once 'Clases/Alumno.php';

if (isset($_GET['fecha']) && isset($_SESSION['institucion_id']) && isset($_SESSION['materia_id'])) {
    $fecha = $_GET['fecha'];
    $institucionId = $_SESSION['institucion_id'];
    $materiaId = $_SESSION['materia_id'];

    $asistencias = Alumno::obtenerAsistenciasPorFecha($materiaId, $fecha);

    echo json_encode($asistencias);
} else {
    echo json_encode([]);
}