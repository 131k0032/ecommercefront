<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="title" content="Tienda virtual">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur amet quae nisi consequatur hic sapiente esse enim maxime aperiam quisquam ullam perspiciatis, omnis, culpa minus unde illum. Aspernatur, assumenda, exercitationem">
	<meta name="keyword" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur amet quae nisi consequatur hic sapiente esse enim maxime aperiam quisquam ullam perspiciatis, omnis, culpa minus unde illum. Aspernatur, assumenda, exercitationem?">
	<title>Tienda virtual</title>	
	<?php session_start(); //Iniciando variables de sesion?>
	<?php  $icono=ControladorPlantilla::ctrEstiloPlantilla(); ?>	
	<?php 
		/*----------  Ruta fija del pryecto  ----------*/
		//Llamado Cuando no tiene respuesta o es directo
		$url = Ruta::ctrRuta();
		// var_dump($url);
		//Llamado Cuando tiene respuesta
		// $ruta = new Ruta();
		// $ruta->ctrRuta();
		// var_dump($ruta)
		$servidor=Ruta::ctrRutaServidor();
		
	 ?>
	 <!--=====================================
	PLUGINS CSS
	======================================-->				
	<link rel="icon" href="<?php echo $servidor; ?><?php echo $icono["icono"]; ?>">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/flexslider.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/sweetalert.css">
	<!-- Fuentes desde Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed&display=swap" rel="stylesheet">
	<!--=====================================
	ESTILO PERSONALIZADAS
	======================================-->				
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/cabezote.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/slide.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/productos.css">
	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/infoproducto.css">
	<!--=====================================
	PLUGINS JS
	======================================-->				
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script><!-- Retardo de animaciones -->
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script><!-- Regresa el scroll Arriba -->
	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.flexslider.js"></script><!-- Slider de info producto -->
	<script src="<?php echo $url; ?>vistas/js/plugins/sweetalert.min.js"></script><!-- Alertas con sweetalert -->



</head>
<body>

<?php 

/*========================
CABEZOTE
========================*/
include "modulos/cabezote.php";

/*========================
CONTENIDO DINAMICO
========================*/
$rutas = array();
$ruta=null;
$infoProducto=null;

if(isset($_GET["ruta"])){//Ruta viene de htaccess

	$rutas = explode("/", $_GET["ruta"]);
	 // var_dump($rutas);
	$item = "ruta" ;//Campo ruta en bd Categoria
	$valor =$rutas[0];//Lo que venga de la url
	// var_dump($valor);
	/*========================
	URLS AMIGABLES DE CATEGORIAS
	========================*/
	$rutaCategorias=ControladorProductos::ctrMostrarCategorias($item, $valor);//No foreach required
	// var_dump($rutaCategorias["ruta"]);
	//Si el indice 0 es igual a lo que recibe en el campo ruta en la bd
	if(is_array($rutaCategorias) && $rutas[0]==$rutaCategorias["ruta"]){
		//ruta de null pasa a tomar el valor recibido en bd
		$ruta=$rutas[0];
		 // echo $ruta;
	}


	/*========================
	URLS AMIGABLES DE SUBCATEGORIAS
	========================*/
	$rutaSubCategorias=ControladorProductos::ctrMostrarSubCategorias($item, $valor);
	// var_dump($rutaSubCategorias["ruta"]);
	foreach ($rutaSubCategorias as $key => $value) {
		if(is_array($rutaSubCategorias) && $rutas[0]==$value["ruta"] ){
			//ruta de null pasa a tomar el valor recibido en bd
			$ruta=$rutas[0];
			// echo $ruta;
			
		}		
	}	


	/*========================
	URLS AMIGABLES DE PRODUCTOS
	========================*/
	$rutaProductos =ControladorProductos::ctrMostrarInfoProducto($item, $valor);//foreach not required
	// var_dump($rutaProductos);
	 // var_dump($rutaProductos['ruta']);
	if(is_array($rutaProductos) && $rutas[0]==$rutaProductos["ruta"]){
		//ruta de null pasa a tomar el valor recibido en bd
		$infoProducto=$rutas[0];
		 // echo $ruta;
	}



	/*========================
	LISTA BLANCA DE URLS AMIGABLES
	========================*/
	// Si ruta ahora es diferente de null muestra la vista productos.php
	if( $ruta!=null || $rutas[0]=="articulos-gratis" ||  $rutas[0]=="lo-mas-vendido" ||  $rutas[0]=="lo-mas-visto" ){

		include "modulos/productos.php";
		//var_dump($rutas[0]);
	    //var_dump($ruta);
	}else if($infoProducto != null){
		include "modulos/infoproducto.php";
	}else if($rutas[0]=="buscador" || $rutas[0]=="verificar"){
		include "modulos/".$rutas[0].".php";
	}else{
		//var_dump($ruta);
		include "modulos/error404.php";
	}
// Si se encuentra en index.php
}
else{	
	include "modulos/slide.php";//Traer slide.php
	include "modulos/destacados.php";
}

?>

<!-- Soluciona un pedo de ajax se manda a plantilla.js--> 
<input type="hidden" value="<?php echo $url;?>" id="rutaOculta">

<!--=====================================
JS PERSONALIZADOS	
======================================-->				
<script src="<?php echo $url; ?>vistas/js/cabezote.js"></script>	
<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>	
<script src="<?php echo $url; ?>vistas/js/slide.js"></script>	
<script src="<?php echo $url; ?>vistas/js/buscador.js"></script>	
<script src="<?php echo $url; ?>vistas/js/infoproducto.js"></script>
<script src="<?php echo $url; ?>vistas/js/usuarios.js"></script>		
</body>
</html>