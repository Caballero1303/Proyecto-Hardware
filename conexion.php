<?php

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "dbecommerce";

// Crear la conexión
$conn = mysqli_connect($servername, $user, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}