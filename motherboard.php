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
	<title>Informacion sobre la motherboard</title>
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
				<h1 id="info">motherboard</h1>
			</font>
		</div>
	</center>
	<div id="lateral">
		<h2>Descripción</h2>
		<div id="descripcion">
			<p>La motherboard, o placa base, es uno de los componentes más importantes de una computadora, ya que actúa
				como la plataforma principal que conecta y coordina todos los demás componentes del sistema. Aquí hay
				información clave sobre la motherboard:

				Funciones principales:
				Conexión de componentes: La motherboard proporciona conectores y zócalos para instalar la CPU, la RAM,
				la tarjeta gráfica, el disco duro, la unidad de estado sólido (SSD), la tarjeta de sonido, la tarjeta de
				red y otros periféricos.

				Interconexión: Utiliza varios buses y puertos (PCIe, SATA, USB, entre otros) para permitir la
				comunicación entre los diferentes componentes de la computadora.

				Circuito impreso: La motherboard es un circuito impreso que contiene caminos eléctricos que conectan los
				componentes entre sí y con la fuente de alimentación.

				BIOS/UEFI: Contiene el firmware básico (BIOS o UEFI) que inicializa y controla el hardware cuando la
				computadora se enciende.

				Factores a considerar:
				Compatibilidad de componentes: Es esencial elegir una motherboard compatible con la CPU y otros
				componentes que planeas utilizar. Deben coincidir en términos de zócalos (como LGA o PGA para CPUs) y
				conectores (PCIe para tarjetas gráficas, ranuras DIMM para RAM, etc.).

				Características y expansión: Las motherboards pueden ofrecer diferentes características, como múltiples
				puertos USB, conexiones SATA para discos duros/SSD, ranuras PCIe para tarjetas de expansión (gráficos,
				sonido, red), conectividad Wi-Fi integrada, entre otras.

				Factor de forma: La motherboard viene en diferentes tamaños (ATX, Micro-ATX, Mini-ITX, etc.). El factor
				de forma afecta el tamaño de la caja de la computadora y la cantidad de componentes que se pueden
				instalar.

				Capacidad de RAM y almacenamiento: La cantidad de ranuras DIMM para RAM y conectores SATA o M.2 para
				unidades de almacenamiento (HDDs/SSDs) que tenga la motherboard determinará la capacidad máxima de RAM y
				almacenamiento que se puede instalar.

				Impacto en el rendimiento:
				Una buena elección de motherboard puede influir en el rendimiento general de la computadora, aunque no
				directamente. Una placa base bien diseñada puede permitir una mejor distribución de energía, una
				comunicación más eficiente entre los componentes y una mayor estabilidad del sistema.

				En resumen, la motherboard es un componente crucial que actúa como el sistema nervioso central de la
				computadora, conectando y coordinando todos los demás componentes para un funcionamiento óptimo del
				sistema.</p>
		</div><br>
	</div>

	<style type="text/css">
		#lateral {
			padding: 30px;
			padding-bottom: 500px;
			color: #fff;
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
			background-color: black;
		}

		#film {
			border-radius: 10px;
			background-color: #333333;
		}
	</style>
</body>

</html>