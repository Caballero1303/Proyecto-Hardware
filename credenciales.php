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
    include ('conexion.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_user"])) {
        $id_user = $_POST["id_user"];
        eliminarRegistro($id_user);
    }

    function eliminarRegistro($id_user) {
        global $conn;
        $sql = "DELETE FROM credenciales WHERE ID_USER = '$id_user'";
        if ($conn->query($sql) === true) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    }

    // Inicializar la variable de búsqueda
    $filtro = "";

    // Verificar si se envió una palabra clave para buscar
    if (isset($_GET['filtro'])) {
    $filtro = $_GET['filtro'];
    }

// Consulta a la tabla "asignaciones" con unión a la tabla "Empleados" y aplicación del filtro de búsqueda
$sql = "SELECT * FROM credenciales WHERE 
            ID_USER LIKE '%$filtro%' OR 
            USER LIKE '%$filtro%' OR 
            TIPO_USER LIKE '%$filtro%'
        ORDER BY FECHA_CREACION DESC";
        
        $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<tr><th>Numero de usuario</th><th>Usuario</th><th>Tipo de usuario</th><th>Contraseña</th><td colspan='2'><center><a class='button' href='alta_credenciales.php'>Agregar un nuevo registro</a></center></td></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='registro'>" . $row["ID_USER"] . "</td>";
            echo "<td class='registro'>" . $row["USER"] . "</td>";
            echo "<td class='registro'>" . $row["TIPO_USER"] . "</td>";
            echo "<td class='registro'>" . $row["PASSWORD"] . "</td>";
            echo "<td><a class='button edit' href='modificar_credenciales.php?id=" . $row["ID_USER"] . "'><img class='boton-img' src='img/editar.png'/></a></td>";
            echo "<td><form method='POST' action='' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'>
            <input type='hidden' name='id_user' value='" . $row["ID_USER"] . "' />
            <button type='submit' class='button delete'><img src='img/eliminar.png'/></button>
            </form></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros.";
        echo "<center><a class='button' href='alta_credenciales.php'>Agregar un nuevo registro</a>";
    }

    $conn->close();
    ?>
</body>
</html>