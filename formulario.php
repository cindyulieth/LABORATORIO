<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$email = $_POST["email"];
$login = $_POST["login"];
$password = $_POST["password"];

// Validar el formato de correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "El correo electrónico ingresado no es válido";
    return;
}

// Validar la longitud de la contraseña
if (strlen($password) < 4 || strlen($password) > 8) {
    echo "La contraseña debe tener entre 4 y 8 caracteres";
    return;
}

// Consultar si el email ya está registrado
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<p class='mensajexito'>el email ya esta registrado, porfavor intentelo de nuevo!</p>";;

    // Volver a ejecutar el formulario de registro
    echo "<script>setTimeout(function() { window.location.href = 'formulario.html'; }, 3000);</script>";
    return;
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";
    
    // Mostrar mensaje de éxito y botón de consulta
     if ($conn->query($sql) === TRUE) {
        echo "<p class='mensajexito'>Registro completado con éxito!</p>";
        echo "<br>";
        echo "<form action='consulta.php' method='GET'>";
        echo "<input type='submit' value='Consulta' class='bconsulta'>";
        echo "</form>";
    } else {
        echo "Error al registrar los datos: " . $conn->error;
    }
$conn->close();
?>



</body>
</html>

