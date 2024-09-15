<?php
// Verificar si se ha proporcionado un ID válido en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de equipo no válido";
    exit();
}

// Obtener el ID del equipo de la URL
$id = $_GET['id'];

// Verificar si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y procesar los datos enviados en el formulario
    $idArt = $_POST['id_articulo'];
    $tipo_art = $_POST['tipo_art'];
    $nombreArt = $_POST['nombre_art'];
    $marcaArt = $_POST['marca_art'];
    $modeloArt = $_POST['modelo_art'];
    $precioArt = $_POST['precio_art'];
    $imgArt = $_POST['img_art'];
    
    // ... Aquí puedes realizar validaciones y procesamiento adicional según tus necesidades

    // Configuración de la conexión a la base de datos
    $servername = "sql5.freesqldatabase.com";
    $user = "sql5730691";
    $password = "1dGVT2BF99";
    $dbname = "sql5730691";

    // Crear la conexión
    $conn = new mysqli($servername, $user, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Actualizar el registro en la tabla "equipos"
    $sql = "UPDATE productos SET 
            id_articulo = '$idArt',
            tipo_art = '$tipo_art',
            nombre_art = '$nombreArt',
            marca_art = '$marcaArt',
            modelo_art = '$modeloArt',
            precio_art = '$precioArt',
            img_art = '$imgArt',
            WHERE id_articulo = '$idArt'";

    if ($conn->query($sql) === true) {
        echo "El equipo se ha actualizado correctamente";
    } else {
        echo "Error al actualizar el equipo: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
    // Redirigir a la página "equipos.php"
    header("Location: equipos.php");
    exit();
} else {
    // Obtener los datos del equipo de la base de datos
    // Configuración de la conexión a la base de datos
    $servername = "sql5.freesqldatabase.com";
    $user = "sql5730691";
    $password = "1dGVT2BF99";
    $dbname = "sql5730691";

    // Crear la conexión
    $conn = new mysqli($servername, $user, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consultar el equipo por ID
    $sql = "SELECT * FROM productos WHERE ID_ART = '$idArt'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del equipo
        $row = $result->fetch_assoc();
        $idArt = $row["ID_ART"];
        $tipo_art = $row["TIPO_ART"];
        $nombreArt = $row["NOMBRE_ART"];
        $marcaArt = $row["MARCA_ART"];
        $modeloArt = $row["MODELO_ART"];
        $precioArt = $row["PRECIO_ART"];
        
        
    } else {
        echo "No se encontró el equipo";
        exit();
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="latitude.ico">
    <link rel="stylesheet" type="text/css" href="css/modificar_equipo.css">
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Editar Equipo</h1>

    <form method="POST" action="">
        <div>
            <label for="id_articulo">Nombre del Equipo:</label>
            <input type="text" id="id_articulo" name="id_articulo" value="<?php echo $idArt; ?>" required>
        </div>
        <div>
            <label for="tipo_art">tipo_art:</label>
            <input type="text" id="tipo_art" name="tipo_art" value="<?php echo $tipo_art; ?>" required>
        </div>
        <div>
            <label for="nombre_art">Marca del Equipo:</label>
            <input type="text" id="nombre_art" name="nombre_art" value="<?php echo $nombreArt; ?>" required>
        </div>
        <div>
            <label for="marca_art">Modelo del Equipo:</label>
            <input type="text" id="marca_art" name="marca_art" value="<?php echo $marcaArt; ?>" required>
        </div>
        <div>
            <label for="modelo_art">Sistema Operativo:</label>
            <input type="text" id="modelo_art" name="modelo_art" value="<?php echo $modeloArt; ?>" required>
        </div>
        <div>
            <label for="precio_art">Marca del Procesador:</label>
            <input type="text" id="precio_art" name="precio_art" value="<?php echo $precioArt; ?>" required>
        </div>
        <div>
            <label for="img_art">Modelo del Procesador:</label>
            <input type="text" id="img_art" name="img_art" value="<?php echo $imgArt; ?>" required>
        </div>

        <div>
            <input type="submit" value="Guardar Cambios">
        </div>
    </form>
</body>
</html>