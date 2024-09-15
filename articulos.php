<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="img/latitude.ico">
    <link rel="stylesheet" type="text/css" href="css/registros.css">
    <title>Consulta de Equipos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/equipos.js"></script>
</head>
<body>
    <div class="header">
        <div>
            <img class="logo" src="img/latitude2.png" alt="Logo de la empresa">
        </div>
        <div class="menu-container">
            <a class="button-menu" href="inicio.php">Inicio</a>
            <a class="button-menu" href="asignaciones.php">Asignaciones</a>
            <a class="button-menu" href="empleados.php">Empleados</a>
            <a class="button-menu" href="equipos.php">Equipos</a>
            <a class="button-menu logout" href="loging.php">Cerrar sesión</a>
        </div>
    </div>
    <h1>Consulta de Equipos</h1>

    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div style="margin-bottom: 20px;">
            <label for="filtro" style="font-weight: bold;">Buscar: </label>
            <input type="text" id="filtro" name="filtro" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <button type="submit" style="padding: 8px 15px; background-color: #007bff; color: #fff; border: none; border-radius: 5px;">Buscar</button>
        </div>
    </form>

    <?php
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
    
    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: loging.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_articulo"])) {
        $id_articulo = $_POST["id_articulo"];
        eliminarRegistro($id_articulo);
    }

    function eliminarRegistro($id_articulo) {
        global $conn;
        $sql = "DELETE FROM productos WHERE ID_ART = '$id_articulo'";
        if ($conn->query($sql) === true) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    }

    // Construir la consulta SQL base
    $sql = "SELECT * FROM productos";

    if (isset($_GET["filtro"])) {
        $filtro = $_GET["filtro"];
        $sql .= " WHERE ID_ART LIKE '%$filtro%' 
                  OR TIPO_ART LIKE '%$filtro%' 
                  OR NOMBRE_ART LIKE '%$filtro%' 
                  OR MARCA_ART LIKE '%$filtro%' 
                  OR MODELO_ART LIKE '%$filtro%' 
                  OR PRECIO_ART LIKE '%$filtro%'";
    }    

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<tr><th>Numero de articulo</th><th>Tipo de articulo</th><th>Articulo</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Imagen</th><td colspan='2'><center><a class='button' href='agregar_equipo.php'>Agregar un nuevo registro</a></center></td></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='registro'>" . $row["ID_ART"] . "</td>";
            echo "<td class='registro'>" . $row["TIPO_ART"] . "</td>";
            echo "<td class='registro'>" . $row["NOMBRE_ART"] . "</td>";
            echo "<td class='registro'>" . $row["MARCA_ART"] . "</td>";
            echo "<td class='registro'>" . $row["MODELO_ART"] . "</td>";
            echo "<td class='registro'>" . $row["PRECIO_ART"] . "</td>";
        
            // Decodificación de la imagen desde el BLOB a base64
            $imagen_binaria = $row["IMG_ART"];
            $imagen_codificada = base64_encode($imagen_binaria);
        
            // Mostrar la imagen en la tabla
            echo "<td class='registro'><img src='data:image/jpeg;base64, $imagen_codificada' alt='Imagen del equipo' class='img-art'></td>";
        
            echo "<td><a class='button edit' href='modificar_articulos.php?id=" . $row["ID_ART"] . "'><img class='boton-img' src='img/editar.png'/></a></td>";
            echo "<td><a class='button delete' onclick='eliminarRegistro(\"" . $row["ID_ART"] . "\")'><img class='boton-img' src='img/eliminar.png'/></a></td>";
            
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros.";
    }

    $conn->close();
    ?>
</body>
</html>