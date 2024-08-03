<?php
session_start();

// Verificar si el usuario no está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirecciona al login si no está logueado
    exit();
}
?>
