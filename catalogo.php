<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/oso_fime.ico" type="image/ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <title>TECHTUTOR</title>
</head>

<body>
    <header>
        <div class="contenedor">
            <font class="logotipo">FIME</font>
            <font class="logotipo2">TECH</font>
            <nav>
                <a href="index.php" class="activo">Inicio</a>
                <a href="catalogo.php" class="activo">Catalogo</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="articulos-recomendados contenedor">
            <div class="contenedor-titulo-controles">
                <h3>Computadoras Armadas</h3>
                <div class="indicadores"></div>
            </div>

            <div class="contenedor-principal">
                <button role="button" id="flecha-izquierda" class="flecha-izquierda"><i class="fas fa-angle-left"></i></button>

                <div class="contenedor-carousel">
                    <div class="carousel">

                        <?php
                        // Conexión a la base de datos
                        $servername = "sql5.freesqldatabase.com";
						$user = "sql5730691";
						$password = "1dGVT2BF99";
						$dbname = "sql5730691";

                        $conn = new mysqli($servername, $user, $password, $dbname);

                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Consulta a la tabla productos
                        $sql = "SELECT IMG_ART, PRECIO_ART FROM productos
						WHERE TIPO_ART='Computadora Armada'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Recorrer cada resultado de la consulta
                            while ($row = $result->fetch_assoc()) {
                                // Convertir el blob de la imagen a base64 para mostrarla en HTML
                                $imgData = base64_encode($row["IMG_ART"]);
                                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
                                $precio = number_format($row["PRECIO_ART"], 2); // Formato de precio

                                echo '
                                <div class="articulo">
                                    <img src="' . $imgSrc . '" alt="Producto">
                                    <div class="precio">$' . $precio . '</div>
                                </div>';
                            }
                        } else {
                            echo "No se encontraron productos.";
                        }

                        // Cerrar la conexión
                        $conn->close();
                        ?>

                    </div>

                    <button role="button" id="flecha-derecha" class="flecha-derecha"><i class="fas fa-angle-right"></i></button>
                </div>
            </div>
        </div>
		<div class="articulos-recomendados contenedor">
            <div class="contenedor-titulo-controles">
                <h3>Procesadores</h3>
                <div class="indicadores"></div>
            </div>

            <div class="contenedor-principal">
                <button role="button" id="flecha-izquierda" class="flecha-izquierda"><i class="fas fa-angle-left"></i></button>

                <div class="contenedor-carousel">
                    <div class="carousel">

                        <?php
                        // Conexión a la base de datos
						$servername = "sql5.freesqldatabase.com";
						$user = "sql5730691";
						$password = "1dGVT2BF99";
						$dbname = "sql5730691";

                        $conn = new mysqli($servername, $user, $password, $dbname);

                        // Verificar la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Consulta a la tabla productos
                        $sql = "SELECT IMG_ART, PRECIO_ART FROM productos
						WHERE TIPO_ART='CPU'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Recorrer cada resultado de la consulta
                            while ($row = $result->fetch_assoc()) {
                                // Convertir el blob de la imagen a base64 para mostrarla en HTML
                                $imgData = base64_encode($row["IMG_ART"]);
                                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
                                $precio = number_format($row["PRECIO_ART"], 2); // Formato de precio

                                echo '
                                <div class="articulo">
                                    <img src="' . $imgSrc . '" alt="Producto">
                                    <div class="precio">$' . $precio . '</div>
                                </div>';
                            }
                        } else {
                            echo "No se encontraron productos.";
                        }

                        // Cerrar la conexión
                        $conn->close();
                        ?>

                    </div>

                    <button role="button" id="flecha-derecha" class="flecha-derecha"><i class="fas fa-angle-right"></i></button>
                </div>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>