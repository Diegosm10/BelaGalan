<?php
require_once "conexion.php";
require_once "Clases\Institucion.php";

$instituciones = Institucion::obtenerInstituciones();

if (isset($_GET['institucion_id'])) {
    $materias = Institucion::obtenerMateriasPorInstitucion($_GET['institucion_id']);
    header('Content-Type: application/json');
    echo json_encode($materias);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnos</title>
    <link rel="stylesheet" href="RESOURCES\CSS\styles.css">
</head>

<body>
    <div class="topnav">
        <a class="active" href="mostrar_alumnos.php">Alumnos</a>
        <a href="registro_alumno.php">Matriculacion</a>
        <a href="registro_asistencia.php">Asistencia</a>
        <a href="registro_notas.php">Califciaciones</a>
    </div>
    <label for="institucion_id">Institución:</label>
    <select id="institucion_id" name="institucion_id" onchange="cargarMaterias()" required>
        <option value="">Seleccione una institución</option>
        <?php foreach ($instituciones as $institucion): ?>
            <option value="<?= $institucion['id']; ?>"><?= $institucion['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="materia_id">Materia:</label>
    <select id="materia_id" name="materia_id" required>
        <option value="">Seleccione una materia</option>
    </select>
</body>
<script src="RESOURCES\JS\fn.js"></script>

</html>