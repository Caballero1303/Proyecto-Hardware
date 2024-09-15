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

    // Manejar la imagen si se ha subido una nueva
    if (!empty($_FILES['img_art']['name'])) {
        $target_dir = "uploads/";  // Directorio de destino
        $target_file = $target_dir . basename($_FILES['img_art']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validar si el archivo es una imagen real
        $check = getimagesize($_FILES['img_art']['tmp_name']);
        if ($check !== false) {
            // Mover la imagen subida a la carpeta de destino
            if (move_uploaded_file($_FILES['img_art']['tmp_name'], $target_file)) {
                $imgArt = $target_file;  // Guardar la ruta de la nueva imagen
            } else {
                echo "Error al subir la imagen.";
                exit();
            }
        } else {
            echo "El archivo subido no es una imagen.";
            exit();
        }
    } else {
        // Si no se subió una nueva imagen, mantener la imagen actual
        $imgArt = $_POST['img_actual'];
    }

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

    // Actualizar el registro en la tabla "productos"
    $sql = "UPDATE productos SET 
            ID_ART = '$idArt',
            TIPO_ART = '$tipo_art',
            NOMBRE_ART = '$nombreArt',
            MARCA_ART = '$marcaArt',
            MODELO_ART = '$modeloArt',
            PRECIO_ART = '$precioArt',
            IMG_ART = '$imgArt'
            WHERE ID_ART = '$idArt'";

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
    $sql = "SELECT * FROM productos WHERE ID_ART = '$id'";
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
        $imgArt = $row["IMG_ART"];  // Obtener la ruta de la imagen actual
    } else {
        echo "No se encontró el artículo";
        exit();
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="latitude.ico">
    <link rel="stylesheet" type="text/css" href="css/registros.css">
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Editar Equipo</h1>

    <form method="POST" action="" enctype="multipart/form-data">
        <div>
            <label for="id_articulo">Nombre del Equipo:</label>
            <input type="text" id="id_articulo" name="id_articulo" value="<?php echo htmlspecialchars($idArt, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="tipo_art">Tipo de artículo:</label>
            <input type="text" id="tipo_art" name="tipo_art" value="<?php echo htmlspecialchars($tipo_art, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="nombre_art">Marca del Equipo:</label>
            <input type="text" id="nombre_art" name="nombre_art" value="<?php echo htmlspecialchars($nombreArt, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="marca_art">Modelo del Equipo:</label>
            <input type="text" id="marca_art" name="marca_art" value="<?php echo htmlspecialchars($marcaArt, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="modelo_art">Sistema Operativo:</label>
            <input type="text" id="modelo_art" name="modelo_art" value="<?php echo htmlspecialchars($modeloArt, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div>
            <label for="precio_art">Marca del Procesador:</label>
            <input type="text" id="precio_art" name="precio_art" value="<?php echo htmlspecialchars($precioArt, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <!-- Mostrar la imagen actual -->
        <div>
            <label>Imagen actual:</label><br>
            <?php
            $imagen_binaria = $row["IMG_ART"];
            $imagen_codificada = base64_encode($imagen_binaria);
            // Mostrar la imagen en la tabla
            echo "<td class='registro'><img src='data:image/jpeg;base64, $imagen_codificada' alt='Imagen del equipo' width='100' height='100'></td>";
            ?>
        </div>
        <div>
            <label for="img_art">Cambiar imagen:</label>
            <input type="file" id="img_art" name="img_art" accept="image/*">
            <!-- Almacenar la ruta de la imagen actual para mantenerla si no se cambia -->
            <input type="hidden" name="img_actual" value="<?php echo htmlspecialchars($imgArt, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div>
            <input type="submit" value="Guardar Cambios">
        </div>
    </form>
</body>
</html>