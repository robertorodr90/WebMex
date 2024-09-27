<?php
$servername = "localhost";
$username = "root";
$password = "root"; // O la contraseña que configuraste para MySQL en MAMP
$dbname = "gestor_tareas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
