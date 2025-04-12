<?php
session_start();
if (!isset($_SESSION['tarea'])) {
    $_SESSION['tarea'] = [];
}

function updatetareatatus($index, $newStatus) {
    if (isset($_SESSION['tarea'][$index])) {
        $_SESSION['tarea'][$index]['status'] = $newStatus;
    }
}

// Función para agregar tarea
function addTask($description) {
    if (!empty(trim($description))) {
        $_SESSION['tarea'][] = [
            'description' => htmlspecialchars($description),
            'status' => 'por hacer'
        ];
    }
}

// Procesar formulario de agregar tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['description'])) {
        addTask($_POST['description']);
    } elseif (isset($_POST['update_status'])) {
        $index = $_POST['task_index'];
        $newStatus = $_POST['new_status'];
        updatetareatatus($index, $newStatus);
    }
    elseif (isset($_POST['eliminar'])) {
        $index = $_POST['task_index'];
        unset($_SESSION['tarea'][$index]);
        $_SESSION['tarea'] = array_values($_SESSION['tarea']); // Reindexar el array
    }
    // Redirigir para evitar reenvío de formulario  
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba Oberstaff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table{
            width: 100%;
            border-collapse: collapse; 
        }
        .tareas {     
            padding: 8px;
            margin: 5px;
            background-color:rgba(249, 249, 249, 0.9);
            border-radius: 5px;
        list-style: ; }
        th{
            font-weight: normal;
        }
        form.inline { display: inline; }
        table tbody tr:nth-child(even),
        table thead tr {
            background-color:aliceblue
        }
        table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .agg { 
            padding: 2px;
            border: 1px solid #938f8f;
            border-radius: 6px;
            height: 25px;
            font-size: 18px;
        }
        .agg_button{
            height: 29px;
            padding: 4px;
            cursor: pointer;
        }
        .button{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Gestor de Tareas</h1>

    <h2>Agregar Tarea</h2>
    <form method="POST">
        <input type="text" class="agg" name="description" placeholder="descripción de la tarea" required>
        <button type="submit" class="agg_button">Agregar</button>
    </form>
    <table>
    <h2>Listado de Tareas</h2>
    <?php if (empty($_SESSION['tarea'])): ?>
        <tr><th>No hay tareas aún.</th></tr>
    <?php else: ?>
        <thead>
            <tr>
            <th>
                <strong>Tarea</strong>
            </th>
            <th>
                <strong>Estado</strong>
            </th>
            <th>
                <strong>Acciones</strong>
            </th>
        </tr>
        </thead>
        
        <tbody>

        
        <?php foreach ($_SESSION['tarea'] as $index => $task): ?>
            <tr>
                <th>
                    <?= $task['description'] ?>
                </th>
                <th>
                    <?= $task['status'] ?>
                </th>
                <th>
                    <form method="POST" class="inline">
                        <input type="hidden" name="task_index" value="<?= $index ?>">
                        <select name="new_status">
                            <option value="por hacer" <?= $task['status'] === 'por hacer' ? 'selected' : '' ?>>Por hacer</option>
                            <option value="en progreso" <?= $task['status'] === 'en progreso' ? 'selected' : '' ?>>En progreso</option>
                            <option value="completada" <?= $task['status'] === 'completada' ? 'selected' : '' ?>>Completada</option>
                        </select>
                        
                        <button type="submit" name="update_status" class="button">Actualizar</button>
                        <button type="submit" name="eliminar" class="button">Eliminar</button>
                    </form>
                </th>

               
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
