<?php
session_start();

$servername = "sql5.freesqldatabase.com";
$user = "sql5730691";
$password = "1dGVT2BF99";
$dbname = "sql5730691";

// Crear la conexión
$conn = mysqli_connect($servername, $user, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, $_POST["USER"]);
    $contraseña = mysqli_real_escape_string($conn, $_POST["PASSWORD"]);

    // Consulta segura para verificar si el usuario y la contraseña coinciden
    $sql = "SELECT * FROM credenciales WHERE USER = '$usuario' AND PASSWORD = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        // Si la consulta falló, muestra el error
        $error_message = "Error en la consulta: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($result) > 0) {
        // El usuario y la contraseña son correctos, se puede permitir el acceso
        $_SESSION['logged_in'] = true;
        $_SESSION['USER'] = $usuario;

        // Redirigir al usuario a otra página
        header("Location: catalogo.php");
        exit();
    } else {
        // El usuario o la contraseña son incorrectos
        $error_message = "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/loging.css">
  <link rel="icon" type="image/x-icon" href="img/latitude.ico"> 
  <title>Formulario de Inicio de Sesión</title>
</head>
<body>
  <div class="container">
    <img src="img/latitude2.png">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error_message)) { ?>
      <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="USER">Usuario</label>
        <input type="text" id="USER" name="USER" placeholder="Ingresa tu usuario" value="<?php echo isset($_POST['USER']) ? $_POST['USER'] : ''; ?>" required>
      </div>
      <div class="form-group">
        <label for="PASSWORD">Contraseña</label>
        <input type="PASSWORD" id="PASSWORD" name="PASSWORD" placeholder="Ingresa tu contraseña" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Iniciar Sesión">
      </div>
    </form>
  </div>
</body>
</html>