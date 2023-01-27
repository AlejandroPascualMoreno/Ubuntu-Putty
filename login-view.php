<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hoja.css">
    <title>Inicia sesión</title>
</head>
<body>
<h1>¡Inicia sesión!</h1>
    <div class="contenedor">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
        <div class="form-group">

        <input type="text" name="usuario" class="usuario" placeholder="Usuario"> </br>
        <input type="password" name="password" class="password" placeholder="Contraseña"> </br>
        <input type="button" name="enviar" class="enviar" value="Acceder" onclick="login.submit()">
        <p>¿No tienes cuenta?</p>
        <a href="registrate.php">Regístrate</a>
        </div>
        </form>

       
    </div>
</body>
</html>