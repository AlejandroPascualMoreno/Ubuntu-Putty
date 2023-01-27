<?php session_start();

// Comprobamos si ya tiene una sesion
# Si ya tiene una sesion redirigimos al contenido, para que no pueda acceder al formulario
if (isset($_SESSION['usuario'])) {
	header('Location: paginacion.php');
	die();
}

// Comprobamos si ya han sido enviado los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];

	// Nos conectamos a la base de datos
	try {
		$conexion = new PDO('mysql:host=localhost;dbname=pruebas', 'root', '');
	} catch (PDOException $e) {
		echo "Error:" . $e->getMessage();
	}

	$statement = $conexion->prepare('SELECT * FROM login_crud WHERE usuario like :usuario AND pass like :pass');
	$statement->execute(array(
			':usuario' => $usuario,
			':pass' => $password
		));

	$resultado = $statement->fetch();
	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		header('Location: paginacion.php');
		
		
	} else {
		$errores = '<li>Datos incorrectos</li>';
	}
}

require 'login-view.php';

?>