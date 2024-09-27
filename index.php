<?php
// Conectamos a la base de datos
include 'db.php';

// Obtenemos todas las tareas de la base de datos
$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gestor de Tareas</h1>
        <form id="task-form" method="POST" action="tasks.php">
            <input type="text" name="title" id="title" placeholder="Título de la tarea" required>
            <textarea name="description" id="description" placeholder="Descripción de la tarea" required></textarea>
            <button type="submit" name="action" value="create">Agregar Tarea</button>
        </form>

        <h2>Lista de Tareas</h2>
        <ul id="task-list">
            <?php while($row = $result->fetch_assoc()): ?>
                <li>
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <a href="tasks.php?action=edit&id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="tasks.php?action=delete&id=<?php echo $row['id']; ?>">Eliminar</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script src="js/app.js"></script>
</body>
</html>