<?php
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['username'])) {
    header("Location: tasks.php");
    exit();
}

// Credenciales predefinidas (se pueden cambiar o usar base de datos)
$valid_username = "admin";
$valid_password = "password123"; // Cambia esta contraseña

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar las credenciales
    if ($username === $valid_username && $password === $valid_password) {
        // Iniciar sesión y redirigir a la lista de tareas
        $_SESSION['username'] = $username;
        header("Location: tasks.php");
        exit();
    } else {
        $error_message = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <div>
                <label for="username">Usuario:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>