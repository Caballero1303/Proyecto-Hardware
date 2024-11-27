<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="img/latitude.ico">
    <title>Ingresar Articulo</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 70px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 30px;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Agregar Articulo</h1>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <div>
            <label for="ID_ART">ID del artículo:</label>
            <input type="text" name="ID_ART" required>
        </div>

        <div>
            <label for="TIPO_ART">Tipo de artículo:</label>
            <input type="text" name="TIPO_ART" required>
        </div>

        <div>
            <label for="NOMBRE_ART">Nombre del artículo:</label>
            <input type="text" name="NOMBRE_ART" required>
        </div>

        <div>
            <label for="MARCA_ART">Marca del artículo:</label>
            <input type="text" name="MARCA_ART" required>
        </div>

        <div>
            <label for="MODELO_ART">Modelo del artículo:</label>
            <input type="text" name="MODELO_ART" required>
        </div>

        <div>
            <label for="PRECIO_ART">Precio del artículo:</label>
            <input type="text" name="PRECIO_ART" required>
        </div>

        <div>
            <label for="IMG_ART">Imagen del artículo:</label>
            <input type="file" name="IMG_ART" accept="image/*" required>
        </div>

        <div>
            <input type="submit" value="Agregar">
        </div>
    </form>
</body>
</html>

<?php
include ('conexion.php');

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de ingreso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos ingresados en el formulario
    $ID_ART = $_POST["ID_ART"];
    $TIPO_ART = $_POST["TIPO_ART"];
    $NOMBRE_ART = $_POST["NOMBRE_ART"];
    $MARCA_ART = $_POST["MARCA_ART"];
    $MODELO_ART = $_POST["MODELO_ART"];
    $PRECIO_ART = $_POST["PRECIO_ART"];
    
    if(isset($_FILES["IMG_ART"]) && $_FILES["IMG_ART"]["error"] == 0) {
        // Obtener los datos binarios de la imagen
        $imgData = file_get_contents($_FILES["IMG_ART"]["tmp_name"]);
        $imgData = $conn->real_escape_string($imgData);

        // Consulta SQL para verificar si el campo ID_ART está duplicado
        $check_duplicate_sql = "SELECT ID_ART FROM productos WHERE ID_ART = '$ID_ART'";
        $duplicate_result = $conn->query($check_duplicate_sql);

        if ($duplicate_result->num_rows > 0) {
            echo '<script>alert("El ID de artículo \'' . $ID_ART . '\' ya existe. Por favor, ingresa otro ID.");</script>';
        } else {
            // Consulta SQL para insertar un nuevo registro en la tabla "productos"
            $insert_sql = "INSERT INTO productos (ID_ART, TIPO_ART, NOMBRE_ART, MARCA_ART, MODELO_ART, PRECIO_ART, IMG_ART)
                    VALUES ('$ID_ART', '$TIPO_ART', '$NOMBRE_ART', '$MARCA_ART', '$MODELO_ART', '$PRECIO_ART', '$imgData')";

            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("Registro insertado correctamente.");</script>';
                header("Location: articulos.php");
            } else {
                echo '<script>alert("Error al insertar el registro: ' . $conn->error . '");</script>';
            }
        }
    }else {
            echo '<script>alert("Error al cargar la imagen.");</script>';
    }
}
// Cerrar la conexión
$conn->close();
?>