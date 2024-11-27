<?php
// Verificar si se ha proporcionado un ID válido en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de equipo no válido";
    exit();
}

// Obtener el ID del equipo de la URL
$id = $_GET['id'];

// Iniciar sesión
session_start();

include('conexion.php');

// Verificar si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y procesar los datos enviados en el formulario
    $idUser = $_POST['id_user'];  // Se necesita agregar este campo oculto en el formulario
    $USER = $_POST['USER'];
    $TIPO_USER = $_POST['tipo_user'];
    $PASSWORD = $_POST['pass'];

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Actualizar el registro en la tabla "credenciales"
    $sql = "UPDATE credenciales SET 
            USER = '$USER',
            TIPO_USER = '$TIPO_USER',
            PASSWORD = '$PASSWORD'
            WHERE ID_USER = '$idUser'";

    if ($conn->query($sql) === true) {
        echo "El equipo se ha actualizado correctamente";
        // Redirigir a la página "equipos.php"
        header("Location: credenciales.php");
        exit();
    } else {
        echo "Error al actualizar el equipo: " . $conn->error;
    }

    $conn->close();
} else {
    // Obtener los datos del equipo de la base de datos
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consultar el equipo por ID
    $sql = "SELECT * FROM credenciales WHERE ID_USER = '$id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $idUser = $row["ID_USER"];
        $USER = $row["USER"];
        $TIPO_USER = $row["TIPO_USER"];
        $PASSWORD = $row["PASSWORD"];
    } else {
        echo "No se encontró el artículo";
        exit();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="latitude.ico">
    <link rel="stylesheet" type="text/css" href="css/modificar.css">
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Editar Equipo</h1>

    <form method="POST" action="">
        <!-- Campo oculto para ID_USER -->
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($idUser, ENT_QUOTES, 'UTF-8'); ?>">

        <div>
            <label for="USER">Usuario:</label>
            <input type="text" id="USER" name="USER" value="<?php echo htmlspecialchars($USER, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="tipo_user">Tipo de Usuario:</label>
            <input type="text" id="tipo_user" name="tipo_user" value="<?php echo htmlspecialchars($TIPO_USER, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="pass">Contraseña:</label>
            <input type="text" id="pass" name="pass" value="<?php echo htmlspecialchars($PASSWORD, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div>
            <input type="submit" value="Guardar Cambios">
        </div>
    </form>
</body>
</html>
