<?php
session_start();

function obtenerPromedioNotas($materiaId)
{
    $notas = Alumno::obtenerNotas($materiaId);
    $promedio_notas = [];

    foreach ($notas as $alumnoId => $notasArray) {
        if (count($notasArray) > 0) {
            $suma = array_sum($notasArray);
            $promedio = $suma / count($notasArray);
            $promedio_notas[$alumnoId] = $promedio;
        } else {
            $promedio_notas[$alumnoId] = 0;
        }
    }

    return $promedio_notas;
}

function obtenerPromedioAsistencias($materiaId, $dias_totales)
{
    $asistencias = Alumno::obtenerAsistencias($materiaId);
    $promedio_asistencia = [];

    foreach ($asistencias as $alumnoId => $cantidadPresente) {
        $promedio_asistencia[$alumnoId] = $dias_totales > 0
            ? ($cantidadPresente / $dias_totales) * 100
            : 0;
    }

    return $promedio_asistencia;
}
