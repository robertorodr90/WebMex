<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'root', 'todolist_db');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Obtener la tarea por su ID
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM tasks WHERE id=$task_id");
    $task = $result->fetch_assoc();
}

// Editar la tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_title = $_POST['task_title'];
    $task_desc = $_POST['task_desc'];
    $mysqli->query("UPDATE tasks SET title='$task_title', description='$task_desc' WHERE id=$task_id");
    header("Location: tasks.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarea</h1>
        
        <form action="edit_task.php?id=<?php echo $task_id; ?>" method="POST">
            <input type="text" name="task_title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            <input type="text" name="task_desc" value="<?php echo htmlspecialchars($task['description']); ?>">
            <button type="submit" name="edit_task">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>