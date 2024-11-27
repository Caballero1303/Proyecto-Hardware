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
            <label for="ID_USER">ID del artículo:</label>
            <input type="text" name="ID_USER" required>
        </div>

        <div>
            <label for="USER">Tipo de artículo:</label>
            <input type="text" name="USER" required>
        </div>

        <div>
            <label for="TIPO_USER">Nombre del artículo:</label>
            <input type="text" name="TIPO_USER" required>
        </div>

        <div>
            <label for="PASSWORD">Marca del artículo:</label>
            <input type="text" name="PASSWORD" required>
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
    $ID_USER = $_POST["ID_USER"];
    $USER = $_POST["USER"];
    $TIPO_USER = $_POST["TIPO_USER"];
    $PASSWORD = $_POST["PASSWORD"];
    
        // Consulta SQL para verificar si el campo ID_USER está duplicado
        $check_duplicate_sql = "SELECT ID_USER FROM credenciales WHERE ID_USER = '$ID_USER'";
        $duplicate_result = $conn->query($check_duplicate_sql);

        if ($duplicate_result->num_rows > 0) {
            echo '<script>alert("El ID de artículo \'' . $ID_USER . '\' ya existe. Por favor, ingresa otro ID.");</script>';
        } else {
            // Consulta SQL para insertar un nuevo registro en la tabla "productos"
            $insert_sql = "INSERT INTO productos (ID_USER, USER, TIPO_USER, PASSWORD)
                    VALUES ('$ID_USER', '$USER', '$TIPO_USER', '$PASSWORD')";

            if ($conn->query($insert_sql) === TRUE) {
                echo '<script>alert("Registro insertado correctamente.");</script>';
                header("Location: articulos.php");
            } else {
                echo '<script>alert("Error al insertar el registro: ' . $conn->error . '");</script>';
            }
        }
    }

// Cerrar la conexión
$conn->close();
?>