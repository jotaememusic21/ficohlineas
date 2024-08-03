<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $valorBoton = isset($_POST['valor']) ? $_POST['valor'] : '';

    if (empty($usuario) || empty($valorBoton)) {
        echo "Usuario o valor del botón no proporcionado.";
        exit;
    }

    $filePath = 'recordware.json';

    // Leer el contenido del archivo JSON
    $jsonData = file_get_contents($filePath);

    // Decodificar el contenido JSON en un array asociativo
    $data = json_decode($jsonData, true);

    $updated = false;

    // Recorrer el array y buscar el usuario
    foreach ($data as &$entry) {
        if ($entry['Usuario'] === $usuario) {
            
                $entry['Token'] = $valorBoton;
                $updated = true;
                break;
            
        }
    }

    if ($updated) {
        // Codificar el array de vuelta a JSON
        $newJsonData = json_encode($data, JSON_PRETTY_PRINT);

        // Guardar los cambios en el archivo JSON
        if (file_put_contents($filePath, $newJsonData)) {
            echo "Valor actualizado correctamente.";
        } else {
            echo "Error al guardar los cambios.";
        }
    } else {
        echo "Usuario no encontrado o Token ya está asignado.";
    }
}
?>
