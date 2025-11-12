<?php
header('Content-Type: application/json');
session_start(); // Iniciar la sesión para acceder a las variables de sesión
include("conexion.php");

$response = [];


if (isset($_POST['id_horario']) && isset($_POST['accion'])) {
    $id_horario = $_POST['id_horario'];
    $accion = $_POST['accion'];

    if (filter_var($id_horario, FILTER_VALIDATE_INT)) {
        if ($accion === 'liberar') {
            // Acción de liberar: solo para administradores
            $id_usuario = $_SESSION['id_usuario'];
            $stmt_admin = mysqli_prepare($conexion, "SELECT rol FROM usuarios WHERE id_usuario = ?");
            mysqli_stmt_bind_param($stmt_admin, "i", $id_usuario);
            mysqli_stmt_execute($stmt_admin);
            $result_admin = mysqli_stmt_get_result($stmt_admin);
            $usuario = mysqli_fetch_assoc($result_admin);

            if ($usuario && (strtolower($usuario['rol']) === 'admin')) {
                // Es admin, proceder a liberar
                $stmt_update = mysqli_prepare($conexion, "UPDATE horario_cancha SET disponible = 1 WHERE id_horario = ?");
                mysqli_stmt_bind_param($stmt_update, "i", $id_horario);
                if (mysqli_stmt_execute($stmt_update)) {
                    $response['success'] = true;
                } else {
                    $response['error'] = "Error al actualizar la base de datos.";
                }
                mysqli_stmt_close($stmt_update);
            } else {
                // No es admin
                $response['error'] = "No tienes permisos para realizar esta acción.";
            }
            mysqli_stmt_close($stmt_admin);

        } elseif ($accion === 'reservar') {
            // Acción de reservar: para cualquier usuario logueado
            // NOTA: Esta lógica ya no se usa desde alquileres.php, pero se deja como referencia
            // y se mejora con una transacción para evitar condiciones de carrera.
            mysqli_begin_transaction($conexion);
            try {
                // Bloquea la fila para evitar que dos usuarios la reserven al mismo tiempo
                $stmt_check = mysqli_prepare($conexion, "SELECT disponible FROM horario_cancha WHERE id_horario = ? FOR UPDATE");
                mysqli_stmt_bind_param($stmt_check, "i", $id_horario);
                mysqli_stmt_execute($stmt_check);
                $result_check = mysqli_stmt_get_result($stmt_check);
                $horario = mysqli_fetch_assoc($result_check);

                if ($horario && $horario['disponible'] == 1) { // Si está disponible
                    $stmt_update = mysqli_prepare($conexion, "UPDATE horario_cancha SET disponible = 0 WHERE id_horario = ?");
                    mysqli_stmt_bind_param($stmt_update, "i", $id_horario);
                    if (mysqli_stmt_execute($stmt_update)) {
                        mysqli_commit($conexion); // Confirma la transacción
                        $response['success'] = true;
                    } else {
                        mysqli_rollback($conexion); // Revierte si falla la actualización
                        $response['error'] = "Error al actualizar la base de datos.";
                    }
                    mysqli_stmt_close($stmt_update);
                } else {
                    mysqli_rollback($conexion); // Revierte si el horario ya no estaba disponible
                    $response['error'] = "Este horario ya no está disponible.";
                }
                mysqli_stmt_close($stmt_check);
            } catch (Exception $e) {
                mysqli_rollback($conexion);
                $response['error'] = "Ocurrió un error inesperado: " . $e->getMessage();
            }
        } else {
            $response['error'] = "Acción no válida.";
        }
    } else {
        $response['error'] = "ID de horario inválido.";
    }
}

mysqli_close($conexion);
echo json_encode($response);
?>