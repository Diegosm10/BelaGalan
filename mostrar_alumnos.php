<?php

require_once 'conexion.php';
require_once 'Clases\Alumno.php';
require_once 'Clases\Persona.php';
require_once 'Traits\funciones.php';


if (isset($_SESSION['institucion_id']) && isset($_SESSION['materia_id'])) {
    $institucionId = $_SESSION['institucion_id'];
    $materiaId = $_SESSION['materia_id'];

    $alumnos = Alumno::mostrarAlumnosMatriculados($institucionId, $materiaId);
    $promedios = obtenerPromedioNotas($materiaId);

    $asistencias = [];
    if (isset($_POST['dias_totales'])) {
        $diasTotales = $_POST['dias_totales'];
        $asistencias = obtenerPromedioAsistencias($materiaId, $diasTotales);
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="RESOURCES\CSS\styles.css">
</head>

<body>
    <a href="index.php" class="home-btn">Inicio</a>
    <form method="POST">
        <label for="dias_totales">Cantidad de días cursados:</label>
        <input type="number" name="dias_totales" id="dias_totales" required>
        <button type="submit">Calcular</button>
    </form>
    <?php if (!empty($asistencias)) { ?>
        <table id="mi-tabla">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Promedio de notas</th>
                    <th>Promedio de asistencias</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alumnos)) {
                    foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo $alumno['nombre']; ?></td>
                            <td><?php echo $alumno['apellido']; ?></td>
                            <td><?php echo number_format($promedios[$alumno['id']], 2); ?></td>
                            <td><?php echo number_format($asistencias[$alumno['id']], 2) . '%'; ?></td>
                        </tr>
                    <?php endforeach;
                } ?>
            </tbody>
        </table>
    <?php } ?>
</body>
<script src="RESOURCES\JS\fn.js"></script>

</html>