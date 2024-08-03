<?php

include "facker.php";

$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Función para verificar si el usuario está accediendo desde un dispositivo móvil
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER['HTTP_USER_AGENT']);
}

// Redirigir según el tipo de dispositivo
if (isMobileDevice()) {
    header("Location: index1.php"); // Redirige a rezise.htm si es un dispositivo móvil o tablet
} else {
    header("Location: index1.php"); // Redirige a index1.html si es desde una PC
}
?>
