<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesamiento de Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .success-message {
            color: #4CAF50;
            font-size: 24px;
        }
        .error-message {
            color: #FF0000;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Datos de conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "registró";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $database);

            // Comprobar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Recoger los datos del formulario
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Preparar la consulta SQL para insertar datos en la base de datos
            $sql = "INSERT INTO new_usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password')";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                echo '<p class="success-message">Registro exitoso</p>';
            } else {
                echo '<p class="error-message">Error: ' . $sql . '<br>' . $conn->error . '</p>';
            }

            // Cerrar la conexión
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
