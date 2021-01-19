<?php $servidor=Ruta::ctrRutaServidor(); ?>
<?php $url = Ruta::ctrRuta(); ?>
<!--======================
TOP
=======================-->

<div class="container-fluid barraSuperior" id="top">
	<div class="container">
		<div class="row">
			<!--======================
			SOCIAL			
			=======================-->
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
				<ul>
					<?php 
						$social=ControladorPlantilla::ctrEstiloPlantilla();
						$jsonRedesSociales = json_decode($social["redesSociales"],true);

						foreach ($jsonRedesSociales as $key => $value) {

							echo '<li>
									 <a href="'.$value["url"].'" target="_blank">
										<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
									  </a>
								   </li>';
							}
					 ?>					

					
					
				</ul>
			</div>


			<!--======================
			REGISTRO
			=======================-->
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
				<ul>
					<?php 

						if(isset($_SESSION["validarSesion"])){
							if($_SESSION["validarSesion"]=="ok"){
								if ($_SESSION["modo"]=="directo"){
									if ($_SESSION["foto"]!="") {
									 echo '<li>
									 		<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">
									 	  </li>';
									}else{
										echo '<li>
									 		<img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">
									 	  </li>';
									}
									echo '<li>|</li>
										  <li><a href="'.$url.'perfil">Ver perfil</a></li>
										  <li>|</li>
										  <li><a href="'.$url.'salir">Ver salir</a></li>';
								}
							}
						}else{

							echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
								<li>|</li>
								<li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';
						}
					
					 ?>
					
				</ul>
			</div>							
		</div>
	</div>
</div>

<!--======================
HEADER
=======================-->
<header class="container-fluid">
	<div class="container">
		<div class="row" id="cabezote">
			<!--======================
			LOGOTIPO
			=======================-->			
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				<a href="<?php echo $url ?>">
					<img src="<?php echo $servidor.$social["logo"] ?>" class="img-responsive" alt="">
				</a>
			</div>
			
			<!--======================
			BLOQUE CATEGORÍAS Y BUSCADOR
			=======================-->			
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
				<!-- BOTON CATEGORÍAS -->
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
					<p>CATEGORÍAS
						<span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span>
					</p>
				</div>

				<!-- BUSCADOR -->
				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					<input type="search" name="buscar" class="form-control" placeholder="Buscar...">
					<span class="input-group-btn">
						<!-- Concatenamos el url localhost+ la palabra buscador -->
						<a href="<?php echo $url ?>buscador/1/recientes">
							<button class="btn btn-default backColor" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</a>
					</span>
				</div>

			</div>
			
			<!--======================
			CARRITO DE COMPRAS
			=======================-->
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				<a href="#">
					<button class="btn btn-default pull-left backColor">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</button>
				</a>
				<p>TU CESTA <span class="cantidadCesta">3</span><br>USD $<span class="sumaCesta">20</span></p>
			</div>
			
		</div>

		
		<!--======================
		CATEGORÍAS
		=======================-->
		<div class="col-xs-12 backColor" id="categorias">
			<?php 	
				//Parametros obigatorios siempre que se pidan en el controlador
				$item=null;
				$valor=null;
				// LLamada de clase e instancia de objeto forma 1
				$categorias=ControladorProductos::ctrMostrarCategorias($item, $valor);
				// var_dump($categorias);

				// LLamada de clase e instancia de objeto forma 2 (no funciona)
				// $categorias= new ControladorProductos();
				// $categorias->ctrMostrarCategorias();

				// Mostrando cateogorías
				foreach ($categorias as $key => $value) {
					echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							<h4>
								<a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
							</h4>
							<hr>
							<ul>';
						  // Mostrando subcateorías
							$item="id_categoria";//igualiamos la variable de arriba al id foraneo de categoria obtenido
							$valor=$value["id"];//igualamos la variable de arribe id de la categoria
						    $subcategorias=ControladorProductos::ctrMostrarSubCategorias($item, $valor);//Paso el parámetro de la categoria
							  foreach ($subcategorias as $key => $value) {
							  	echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';	
							  }						  
								
							echo '</ul>
						</div>';		
				}

			 ?>
			
		</div>
	</div>
</header>

<!--============================================
=            VENTANA MODAL REGISTRO            =
=============================================-->

<!-- Modal -->
<div id="modalRegistro" class="modal fade modalFormulario" role="dialog">
    <!-- Modal content-->
    <div class="modal-content modal-dialog">
      
    	  <div class="modal-body modalTitulo">
	      	<h3 class="backColor">Registrarse</h3>
	      	 <button type="button" class="close" data-dismiss="modal">&times;</button>
	      		<!-- Registro Facebook -->
	      		<div class="col-sm-6 col-xs-12 facebook" id="btnFacebookRegistro">
	      			<p>
	      				<i class="fa fa-facebook"></i>
	      				Registro con Facebook
	      			</p>
	      		</div>
	      		<!-- Registro Google -->
	      		<div class="col-sm-6 col-xs-12 google" id="btnGoogleRegistro">
	      			<p>
	      				<i class="fa fa-google"></i>
	      				Registro con Google
	      			</p>
	      		</div>
	      		<!-- Formulario directo -->
	      		<form method="POST" onsubmit="return registroUsuario()">
	      			<hr>
	      			<div class="form-group">
	      				<div class="input-group">
	      					<span class="input-group-addon">
	      						<i class="glyphicon glyphicon-user"></i>
	      					</span>
	      					<input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre completo" required>
	      				</div>
	      			</div>

	      			<div class="form-group">
	      				<div class="input-group">
	      					<span class="input-group-addon">
	      						<i class="glyphicon glyphicon-envelope"></i>
	      					</span>
	      					<input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="Correo electronico" required>
	      				</div>
	      			</div>

	      			<div class="form-group">
	      				<div class="input-group">
	      					<span class="input-group-addon">
	      						<i class="glyphicon glyphicon-lock"></i>
	      					</span>
	      					<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>
	      				</div>
	      			</div>
	      			<!-- Politicas de privacidad -->

	      			<div class="checkbox">
	      				<label for="">
	      					<input type="checkbox" id="regPoliticas">
	      					<small>
	      						Al registrarse, aceptas los términos y condiciones de uso del sitio
	      					</small>
	      				</label>
	      			</div>
	      			<?php 
	      				$registro = new ControladorUsuarios();
	      				$registro->ctrRegistroUsuario();
	      			 ?>
	      			<!-- Boton enviar -->
	      			<input type="submit" class="btn btn-default backColor btn-block" value="Registrarse">

	      		</form>
	      </div>
	      <div class="modal-footer">
	        ¿Ya tienes una cuenta? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>
	      </div>
    </div>
</div>



<!--============================================
=            VENTANA MODAL INGRESO             =
=============================================-->

<!-- Modal -->
<div id="modalIngreso" class="modal fade modalFormulario" role="dialog">
    <!-- Modal content-->
    <div class="modal-content modal-dialog">
      
    	  <div class="modal-body modalTitulo">
	      	<h3 class="backColor">Ingresar</h3>
	      	 <button type="button" class="close" data-dismiss="modal">&times;</button>
	      		<!-- Ingreso Facebook -->
	      		<div class="col-sm-6 col-xs-12 facebook" id="btnFacebookRegistro">
	      			<p>
	      				<i class="fa fa-facebook"></i>
	      				Ingreso con Facebook
	      			</p>
	      		</div>
	      		<!-- Ingreso Google -->
	      		<div class="col-sm-6 col-xs-12 google" id="btnGoogleRegistro">
	      			<p>
	      				<i class="fa fa-google"></i>
	      				Ingreso con Google
	      			</p>
	      		</div>
	      		<!-- Formulario directo -->
	      		<form method="POST">
	      			<hr>
	      			<div class="form-group">
	      				<div class="input-group">
	      					<span class="input-group-addon">
	      						<i class="glyphicon glyphicon-envelope"></i>
	      					</span>
	      					<input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="Correo electronico" required>
	      				</div>
	      			</div>

	      			<div class="form-group">
	      				<div class="input-group">
	      					<span class="input-group-addon">
	      						<i class="glyphicon glyphicon-lock"></i>
	      					</span>
	      					<input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>
	      				</div>
	      			</div>
	      			<?php 
	      				$ingreso = new ControladorUsuarios();
	      				$ingreso->ctrIngresoUsuario();
	      			 ?>
	      			<!-- Boton enviar -->
	      			<input type="submit" class="btn btn-default backColor btn-block btnIngreso" value="Ingresar">

	      		</form>
	      </div>
	      <div class="modal-footer">
	        ¿No tienes una cuenta? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
	      </div>
    </div>
</div>
