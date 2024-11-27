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
    $img_data = null;  // Inicializar la variable de imagen

    if (!empty($_FILES['img_art']['tmp_name'])) {
        echo "Imagen subida correctamente."; // Depuración
        $imageFileType = strtolower(pathinfo($_FILES['img_art']['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'ico'];
    
        if (in_array($imageFileType, $allowed_types)) {
            $img_data = file_get_contents($_FILES['img_art']['tmp_name']);
        } else {
            echo "<script>alert('Solo se permiten archivos de imagen (JPG, JPEG, PNG, GIF).')</script>";
            exit();
        }
    } else {
        echo "No se subió ninguna imagen."; // Depuración
    }
    

    include('conexion.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Construir la consulta con o sin imagen
    if ($img_data !== null) {
        // Consulta sin imagen
        $sql = $conn->prepare("UPDATE productos SET NOMBRE_ART = ?, TIPO_ART = ?, MARCA_ART = ?, MODELO_ART = ?, PRECIO_ART = ? WHERE ID_ART = ?");
        $sql->bind_param("ssssdi", $nombreArt, $tipo_art, $marcaArt, $modeloArt, $precioArt, $idArt);
    } else {
        // Consulta con imagen
        $sql = $conn->prepare("UPDATE productos SET NOMBRE_ART = ?, TIPO_ART = ?, MARCA_ART = ?, MODELO_ART = ?, PRECIO_ART = ?, IMG_ART = ? WHERE ID_ART = ?");
        $sql->bind_param("ssssdbi", $nombreArt, $tipo_art, $marcaArt, $modeloArt, $precioArt, $imgArt, $idArt);
    }
    
    // Ejecutar la consulta
    if ($sql->execute()) {
        echo "El equipo se ha actualizado correctamente.";
    } else {
        echo "Error al actualizar el equipo: " . $conn->error;
    }
  
    $conn->close();
    header("Location: articulos.php");
    exit();
} else {
    include('conexion.php');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT * FROM productos WHERE ID_ART = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $idArt = $row["ID_ART"];
        $tipo_art = $row["TIPO_ART"];
        $nombreArt = $row["NOMBRE_ART"];
        $marcaArt = $row["MARCA_ART"];
        $modeloArt = $row["MODELO_ART"];
        $precioArt = $row["PRECIO_ART"];
        $imgArt = $row["IMG_ART"];
    } else {
        echo "No se encontró el artículo.";
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
        
        <div>
            <label>Imagen actual:</label><br>
            <?php echo "<img src='data:image/jpeg;base64," . base64_encode($imgArt) . "' alt='Imagen del equipo' width='100' height='100'>"; ?>
        </div>
        <div>
            <label for="img_art">Cambiar imagen:</label>
            <input type="file" id="img_art" name="img_art" accept="image/*">
        </div>

        <div>
            <input type="submit" value="Guardar Cambios">
        </div>
    </form>
</body>
</html>
