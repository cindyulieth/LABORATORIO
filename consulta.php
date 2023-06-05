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

// Consulta a la base de datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Lista de usuarios registrados:</h2>";
    echo "<ul class='lista'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["nombre"] . " " . $row["apellido1"] . " " . $row["apellido2"] . "</li>";
    }
    echo "</ul>";

    // Botón "Volver al formulario"
    echo "<form action='formulario.html' method='GET'>";
    echo "<input type='submit' value='volver al formulario' class='mensajevolver'>";
    echo "</form>";
} else {
    echo "No se encontraron usuarios registrados";
}

// Liberar los recursos de la consulta
$result->free();

$conn->close();
?>
</body>
</html>

