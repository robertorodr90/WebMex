<?php
// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "root", "todolist_db");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Agregar nueva tarea
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $mysqli->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    $stmt->close();
}

// Eliminar tarea
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $mysqli->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Tareas</h1>

        <!-- Formulario para añadir nueva tarea -->
        <div class="form-container">
            <form action="tasks.php" method="POST">
                <input type="text" name="title" placeholder="Título de la tarea" required>
                <textarea name="description" placeholder="Descripción de la tarea" rows="3"></textarea>
                <button type="submit" name="add">Agregar Tarea</button>
            </form>
        </div>

        <!-- Lista de tareas -->
        <?php
        // Obtener tareas de la base de datos
        $result = $mysqli->query("SELECT * FROM tasks");
        $taskNumber = 1; // Para numerar las tareas

        while ($task = $result->fetch_assoc()): ?>
            <div class="task">
                <div>
                    <h2><?= $taskNumber . '. ' . $task['title']; ?></h2>
                    <p><?= $task['description']; ?></p>
                </div>
                <div class="task-buttons">
                    <a href="edit_task.php?id=<?= $task['id']; ?>"><button>Editar</button></a>
                    <a href="tasks.php?delete=<?= $task['id']; ?>"><button class="delete">Eliminar</button></a>
                </div>
            </div>
        <?php
        $taskNumber++;
        endwhile;
        ?>
    </div>

    <footer class="footer">
        <a href="logout.php">Cerrar Sesión</a>
    </footer>
</body>
</html>
