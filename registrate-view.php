<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hoja.css">
    <title>Regístrate</title>
</head>
<body>
<h1>¡Regístrate!</h1>
    <div class="contenedor">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
        <div class="form-group">

        <input type="text" name="usuario" class="usuario" placeholder="Usuario"> </br>
        <input type="password" name="password" class="password" placeholder="Contraseña"> </br>
        <input type="password" name="password2" class="repeat-password" placeholder="Repita la contraseña"></br>
        <input type="button" name="enviar" class="enviar" value="Registrarse" onclick="login.submit()">
        <p>¿Ya tienes cuenta?</p>
        <a href="login.php">Inicia sesión</a>
        </div>
        </form>

        
    </div>
</body>
</html>