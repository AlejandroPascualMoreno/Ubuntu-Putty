<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="hoja.css">
<title>CRUD</title>
</head>

<body>
<?php session_start();

// Comprobamos tenga sesion, si no entonces redirigimos y MATAMOS LA EJECUCION DE LA PAGINA.
if(isset($_SESSION['usuario'])) {

} else {
	// Enviamos al usuario al formulario de registro
	header('Location: registrate.php');
}

?>	
<?php
	 include('conexion.php');

/*		$sql_total="SELECT * FROM productos";*/
		$registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
		$estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/
		
			if (isset($_GET["pagina"])){
				$estoy_en_pagina=$_GET["pagina"];				
			}
		
		$empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;
		
		$sql_total="SELECT * FROM productos";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
		$resultado=$base->prepare($sql_total);
		$resultado->execute(array());
		
		$num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
		$total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/

/* ESTA PRIMERA CONSULTA ES PARA SABER NUMERO TOTAL DE REGISTROS Y MOSTRAR LAS PAGINAS Y REGISTROS QUE HAY*/
		
/*		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			echo "Código Articulo: " . $registro['CODIGOARTICULO'] . " Seccion: " . $registro['SECCION'] ." Nombre Articulo: " . $registro['NOMBREARTICULO'] .  " Precio: " . $registro['PRECIO'] .  " Fecha: " . $registro['FECHA'] .  " Importado: " . $registro['IMPORTADO'] . " Pais de Origen: " . $registro['PAISDEORIGEN'] . "<br>";
		}*/
		
		$sql_limite="SELECT * FROM productos LIMIT $empezar_desde,$registros_por_pagina";
		$resultado=$base->prepare($sql_limite);
		$resultado->execute(array());
	
?>
<?php

$registro=$base->query("SELECT * FROM productos LIMIT $empezar_desde,$registros_por_pagina")->fetchAll(PDO::FETCH_OBJ);
 //Añadir
 if (isset($_POST["cr"])) {
    $codigoarticulo = $_POST["CODIGOARTICULO"];
    $seccion = $_POST["SECCION"];
    $nombrearticulo = $_POST["NOMBREARTICULO"];
    $precio = $_POST["PRECIO"];
    $fecha = $_POST["FECHA"];
    $importado = $_POST["IMPORTADO"];
    $paisdeorigen = $_POST["PAISDEORIGEN"];
    $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES(:codArt, :seccion, :nomArt, :precio, :fecha, :importado, :paisOri)";
    $resultado = $base->prepare($sql);
    $resultado->execute(array(":codArt" => $codigoarticulo, ":seccion" => $seccion, ":nomArt" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisOri" => $paisdeorigen));
    header("location:paginacion.php");
  }

  if (isset($_GET["pagina"])){
    $estoy_en_pagina=$_GET["pagina"];				
  }

  
  //Se comprueba si el formulario no est'a vacio
  if (isset($_POST["submit"]) && !empty($_POST["busqueda"])) {
    // Filtramos los datos
    $codigoarticulo = "%" . $_POST["busqueda"] . "%";
    $seccion = "%" . $_POST["busqueda"] . "%";
    $nombrearticulo = "%" . $_POST["busqueda"] . "%";
    $precio = "%" . $_POST["busqueda"] . "%";
    $fecha = "%" . $_POST["busqueda"] . "%";
    $importado = "%" . $_POST["busqueda"] . "%";
    $paisdeorigen = "%" . $_POST["busqueda"] . "%";
    $conexion = $base->prepare("SELECT * FROM productos WHERE CODIGOARTICULO LIKE :codArt or SECCION LIKE :seccion or NOMBREARTICULO LIKE :nomArt or PRECIO LIKE :precio or FECHA LIKE :fecha or IMPORTADO LIKE :importado or PAISDEORIGEN LIKE :paisOri");
    $conexion->execute(array(":codArt" => $codigoarticulo, ":seccion" => $seccion, ":nomArt" => $nombrearticulo, ":precio" => $precio, ":fecha" => $fecha, ":importado" => $importado, ":paisOri" => $paisdeorigen));
    $registro = $conexion->fetchAll(PDO::FETCH_OBJ);
  }

  ?>
 <h1>CRUD CESUR 2022<span class="subtitulo">Create Read Update Delete</span></h1>
  <a href="cerrar.php"><button>Cerrar sesión</button></a>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="50%" border="0" align="center">
      <tr>
        <td colspan="7" class="primera_fila">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="busqueda" placeholder="Introduzc la busqueda">
            <input type="submit" name="submit" value="🔍">
            <a href="index.php"><button>🔙</button></a>
          </form>
        </td>
      </tr>
      <tr>
        <td class="primera_fila">CODIGOARTICULO</td>
        <td class="primera_fila">SECCION</td>
        <td class="primera_fila">NOMBREARTICULO</td>
        <td class="primera_fila">PRECIO</td>
        <td class="primera_fila">FECHA</td>
        <td class="primera_fila">IMPORTADO</td>
        <td class="primera_fila">PAISDEORIGEN</td>
        
      </tr>


      <?php

      foreach ($registro as $articulo): ?>

      <!-- Lineas a repetir -->
      <tr>
        <!-- Por cada persona repetida se pone cada uno de sus campos -->
        <td>
          <?php echo $articulo->CODIGOARTICULO ?>
        </td>
        <td>
          <?php echo $articulo->SECCION ?>
        </td>
        <td>
          <?php echo $articulo->NOMBREARTICULO ?>
        </td>
        <td>
          <?php echo $articulo->PRECIO ?>
        </td>
        <td>
          <?php echo $articulo->FECHA ?>
        </td>
        <td>
          <?php echo $articulo->IMPORTADO ?>
        </td>
        <td>
          <?php echo $articulo->PAISDEORIGEN ?>
        </td>


        <!-- Llamamos al archivo de borrar y le pasamos el parametro id (debe ser el mismo que la tabla no como en borrar.php) de la persona -->
        <td class="bot"><a href="borrar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?>"><input type='button' name='del' id='del'
              value='🗑️'></a></td>
        <td class='bot'><a
            href="editar.php?CODIGOARTICULO=<?php echo $articulo->CODIGOARTICULO ?> & SECCION=<?php echo $articulo->SECCION ?> & NOMBREARTICULO=<?php echo $articulo->NOMBREARTICULO?> & PRECIO=<?php echo $articulo->PRECIO ?>& FECHA=<?php echo  $articulo->FECHA ?> & IMPORTADO=<?php echo $articulo->IMPORTADO ?> & PAISDEORIGEN=<?php echo $articulo->PAISDEORIGEN ?>"><input
              type='button' name='up' id='up' value='📝'></a></td>
             
      </tr>

      <?php

      endforeach;

      ?>


      <tr>
        <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='SECCION' size='10' class='centrado'></td>
        <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
        <td><input type='text' name=' FECHA' size='10' class='centrado'></td>
        <td><input type='text' name=' IMPORTADO' size='10' class='centrado'></td>
        <td><input type='text' name=' PAISDEORIGEN' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='➕'></td>
      </tr>
      <td colspan=7>
    <?php
    /*-------------------------PAGINACION-----------------*/
 
	for ($i=1; $i<=$total_paginas; $i++){
/*		echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";*/
		echo "<a href='paginacion.php?pagina=" . $i . "'>" . $i . "</a>  ";
	}
    
    ?>
</td>
    </table>
</body>
</html>
