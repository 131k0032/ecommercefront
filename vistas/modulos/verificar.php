<!--=================================================
=            VERIFICANDO EMAIL EXISTENTE            =
==================================================-->

<?php
	// Obtenemos coincidencias del email emailEncriptado
	$item ="emailEncriptado";//Campo de bd 
	$valor = $rutas[1]; //valor que contiene el item o campo de la bd
	// var_dump($verificar);
	$respuesta= ControladorUsuarios::ctrMostrarUsuario($item, $valor);
	// var_dump($respuesta);
	

	$id = $respuesta["id"];
	$item2="verificacion";
	$valor2=0;
	$respuesta2= ControladorUsuarios::ctrActualizarUsuario($id, $item2, $valor2);
	//var_dump($respuesta2);

	$usuarioVerificado=false;

	if($respuesta2=="ok"){//Viene del controlador
		$usuarioVerificado =true;
	}

 ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center verificar">
			<?php 

				if($usuarioVerificado){
					echo '<h3>Gracias</h3>
						<h2><small>Cuenta verificada</small></h2>
						<br>
						<a href="#modalIngreso" data-toggle><button class="btn btn-default backColor btn-lg">Ingresar</button></a>

					';
				}else{
					echo '<h3>Error</h3>
						<h2><small>No se ha podido verificar el correo, vuelta a registrarse</small></h2>
						<br>
						<a href="#modalRegistro" data-toggle><button class="btn btn-default backColor btn-lg">Registro</button></a>

					';

				}

			 ?>
		</div>
	</div>
</div>
