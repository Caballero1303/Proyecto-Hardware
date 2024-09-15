<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado una imagen
if ($_FILES['image']['size'] > 0) {
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $image = $conn->real_escape_string($image);

    // Insertar imagen en la base de datos
    $sql = "INSERT INTO imagenes (imagen) VALUES ('$image')";
    if ($conn->query($sql) === TRUE) {
        echo "Imagen subida correctamente.";
    } else {
        echo "Error al subir imagen: " . $conn->error;
    }
} else {
    echo "Por favor selecciona una imagen.";
}

$conn->close();
?>