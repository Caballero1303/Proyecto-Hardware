<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="img/oso_fime.ico" type="image/ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap"
		rel="stylesheet">
	<title> TECHTUTOR </title>
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
		<div class="articulo-principal">
			<div class="contenedor">
				<h3 class="titulo">¿Que es el Hardware?
				</h3>
				<p class="descripcion">
					El hardware se refiere a la parte física y tangible de un sistema informático o dispositivo
					electrónico. Incluye todos los componentes físicos que puedes tocar y ver, en contraste con el
					software, que es la parte lógica e intangible del sistema. El hardware es esencial para el
					funcionamiento de cualquier dispositivo electrónico, desde computadoras y teléfonos inteligentes
					hasta electrodomésticos y sistemas de entretenimiento.
				</p>
				<a href="hardware.php"><button role="button" class="boton"><i class="fas fa-info-circle"></i>Más
						información</button></a>
			</div>
		</div>

		<div class="hardwarecontainer">
			<h1 class="hardware">Hardware de una computadora</h1>
			<div class="hardwarebutton-container">
				<a href="cpu.php">Procesador</a>
				<a href="gpu.php">GPU</a>
				<a href="ram.php">Memoria RAM</a>
				<a href="ssd.php">Almacenamiento</a>
				<a href="motherboard.php">Placa Base</a>
				<a href="poder.php">Fuente de Poder</a>
				<a href="liquido.php">Enfriamento</a>
				<a href="gabinete.php">Gabinete</a>
			</div>
		</div>


	</main>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
</body>

</html>
