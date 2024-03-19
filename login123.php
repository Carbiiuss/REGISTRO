<?php
session_start();

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

    // Consulta SQL para verificar si el usuario existe y las credenciales son correctas
    $sql = "SELECT * FROM new_usuarios WHERE nombre='$nombre' AND email='$email' AND contraseña='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son correctas, iniciar sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        // Redirigir al usuario a la página principal
        header("Location: inicio1.html");
        exit; // Terminar el script para evitar que se ejecute más código
    } else {
        // El usuario no existe o las credenciales son incorrectas
        echo "Usuario, email o contraseña incorrectos";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
