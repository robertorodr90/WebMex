<?php
include 'db.php';

// Crear una nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $conn->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    
    header("Location: index.php");
    exit();
}

// Eliminar una tarea
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    header("Location: index.php");
    exit();
}

// Aquí puedes agregar la lógica de actualización (UPDATE)
