<?php
session_start();

// Datos fijos de prueba
$correct_username = 'morroco1';
$correct_password = 'Dame.plata';

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Verificar si los datos son correctos
if ($username === $correct_username && $password === $correct_password) {
    $_SESSION['loggedin'] = true;
    header('Location: warien.php'); // Redirecciona a la página principal si el login es correcto
    exit();
} else {
    header('Location: login.php?error=1'); // Redirecciona de vuelta al login con un mensaje de error
    exit();
}
?>
