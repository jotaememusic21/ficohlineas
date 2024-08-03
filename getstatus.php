<?php
include "facker.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';

    if (empty($usuario)) {
        echo "Usuario no proporcionado.";
        exit;
    }

    $filePath = './ware/recordware.json';

    // Leer el contenido del archivo JSON
    $jsonData = file_get_contents($filePath);

    // Decodificar el contenido JSON en un array asociativo
    $data = json_decode($jsonData, true);

    // Verificar si la decodificación fue exitosa
    if (!is_array($data)) {
        echo "Error al leer los datos.";
        exit;
    }

    // Buscar el usuario y devolver el valor del campo Token
    foreach ($data as $entry) {
        // Verificar si el campo Usuario existe en la entrada
        if (isset($entry['Usuario']) && $entry['Usuario'] === $usuario) {
            echo $entry['Token'];
            exit;
        }
    }

    echo "Usuario no encontrado.";
}
?>
