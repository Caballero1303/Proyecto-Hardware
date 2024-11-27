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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_articulo"])) {
        $id_articulo = $_POST["id_articulo"];
        eliminarRegistro($id_articulo);
    }

    function eliminarRegistro($id_articulo) {
        global $conn;
        $sql = "DELETE FROM credenciales WHERE ID_USER = '$id_articulo'";
        if ($conn->query($sql) === true) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
    }

    // Construir la consulta SQL base
    $sql = "SELECT * FROM credenciales";

    if (isset($_GET["filtro"])) {
        $filtro = $_GET["filtro"];
        $sql .= " WHERE ID_USER LIKE '%$filtro%' 
                  OR TIPO_USER LIKE '%$filtro%' 
                  OR USER LIKE '%$filtro%'";
    }    

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<tr><th>Numero de usuario</th><th>Tipo de usuario</th><th>Usuario</th><th>Contraseña</th><td colspan='2'><center><a class='button' href='agregar_equipo.php'>Agregar un nuevo registro</a></center></td></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='registro'>" . $row["ID_USER"] . "</td>";
            echo "<td class='registro'>" . $row["TIPO_USER"] . "</td>";
            echo "<td class='registro'>" . $row["USER"] . "</td>";
            echo "<td class='registro'>" . $row["PASSWORD"] . "</td>";
            echo "<td><a class='button edit' href='modificar_articulos.php?id=" . $row["ID_USER"] . "'><img class='boton-img' src='img/editar.png'/></a></td>";
            echo "<td><a class='button delete' onclick='eliminarRegistro(\"" . $row["ID_USER"] . "\")'><img class='boton-img' src='img/eliminar.png'/></a></td>";

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