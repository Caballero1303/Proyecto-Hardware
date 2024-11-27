<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="img/oso_fime.ico" type="image/ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap"
		rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
	<title>Informacion sobre la GPU</title>
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
	
	<center>
		<div id="film">
			<font id="title" color="#aaa6b4">
				<h1 id="info">GPU (Graphics Processing Unit)</h1>
			</font>
		</div>
	</center>
	<div id="lateral">
		<h2>Descripción</h2>
		<div id="descripcion">
			<p>
				La GPU (Unidad de Procesamiento Gráfico, por sus siglas en inglés) es un componente esencial en las
				computadoras y otros dispositivos que se encarga de procesar gráficos y visualizar imágenes en la
				pantalla. Su función principal es acelerar y optimizar el procesamiento de datos relacionados con
				gráficos, lo que incluye renderizar imágenes, videos, animaciones y ejecutar aplicaciones que requieren
				una representación visual intensiva.
				<br>

				Las GPUs están diseñadas con cientos o miles de núcleos pequeños que trabajan en paralelo para procesar
				grandes cantidades de información gráfica de manera rápida y eficiente. Esto es particularmente útil
				para tareas como juegos, diseño 3D, modelado, edición de video, inteligencia artificial y cómputo
				científico.
				<br>

				<strong> Características importantes de una GPU incluyen:</strong>
				<br>

				Velocidad de reloj: La velocidad a la que funcionan los núcleos de la GPU.
				Memoria: La cantidad de memoria (VRAM) que determina la capacidad de la GPU para manejar texturas y
				datos de gráficos.
				Arquitectura: El diseño interno de la GPU, que puede variar entre fabricantes y modelos.
				Renderización y Shaders: La capacidad de la GPU para renderizar escenas y ejecutar shaders, pequeños
				programas que controlan el aspecto visual de los objetos en una escena.
				Consumo de energía y enfriamiento: Puesto que las GPUs pueden generar mucho calor, es crucial considerar
				su consumo de energía y el sistema de enfriamiento al integrarlas en un sistema.
				En los últimos años, las GPUs han adquirido una importancia adicional debido a su uso en el ámbito del
				aprendizaje profundo (deep learning) y la inteligencia artificial. Sus capacidades de procesamiento
				paralelo y su habilidad para manejar grandes conjuntos de datos las han convertido en componentes
				fundamentales en estas áreas.
				<br>

				Los fabricantes más conocidos de GPUs incluyen NVIDIA y AMD, cuyos modelos se utilizan en una amplia
				gama de dispositivos, desde computadoras de escritorio hasta laptops, consolas de juegos y sistemas
				especializados de alto rendimiento para tareas de cómputo intensivas.</p>
		</div><br>

	</div>

	<style type="text/css">
		#lateral {
			padding: 30px;
			padding-bottom: 500px;
			color: #ffffff;
		}

		#info {
			font-family: 'Bebas Neue', cursive;
			color: #ffffff;
		}

		.button {
			display: inline-block;
			padding: 15px 25px;
			font-size: 24px;
			cursor: pointer;
			text-align: center;
			text-decoration: none;
			outline: none;
			color: #fff;
			background-color: #4CAF50;
			border: none;
			border-radius: 15px;
		}

		.button:hover {
			background-color: #3e8e41
		}

		p a:hover {
			background: blue;
			color: #000;
			border-radius: 5px;
		}

		p {
			color: white;
			letter-spacing: 1.5px;
			line-height: 35px;
		}

		p a {
			color: white;
		}

		#descripcion {
			background-color: #333333;
			border-radius: 8px;
		}

		#film {
			border-radius: 10px;
			background-color: #333333;
		}
	</style>
</body>

</html>