<?php $servidor=Ruta::ctrRutaServidor(); ?>
<?php $url = Ruta::ctrRuta(); ?>

<!--================================================
=            MIGA DE PAN INFO PRODUCTOS            =
=================================================-->
<div class="container-fluid well well-sm">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				<li><a href="<?php echo $url ?>">Inicio</a></li>
				<!-- .paginaActiva nos manda a plantilla .js para modificar su estructura -->
				<li class="active pagActiva"><?php echo $rutas[0]; ?></li>
			</ul>
		</div>
	</div>
</div>

<!--================================================
=            INFO PRODUCTO                         =
=================================================-->
<div class="container-fluid infoproducto">
	<div class="container">
		<div class="row">
			<?php 
				$item="ruta";
				$valor=$rutas[0];
				$infoproducto= ControladorProductos::ctrMostrarInfoProducto($item, $valor);
				// var_dump($infoproducto);
				// var_dump($infoproducto["multimedia"]);

				/*=========================================
				=            PRODUCTOS FISICOS            =
				=========================================*/
		
				
				

				if ($infoproducto["tipo"]=="fisico") {

				   
                $multimedia=json_decode($infoproducto["multimedia"],true);
			    //var_dump($multimedia[0]["foto"]);

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
							<figure class="visor">';

								if($multimedia != null){
									for ($i=0; $i<count($multimedia) ; $i++) { 
										echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="tennis verde 11">';
										}

									echo '</figure>

									<div class="flexslider">
									  <ul class="slides">';

							  		for ($i=0; $i<count($multimedia) ; $i++) { 
										echo '<li>
											    <img  value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
											   </li>';
									}
								
								}

							  echo '</ul>
							</div>
						</div>';
				}else{
					//var_dump($infoproducto["multimedia"]);
				/*=========================================
				=            PRODUCTOS VIRTUALES           =
				=========================================*/
				echo '<div class="col-sm-6 col-xs-12">
					<iframe class="videoPresentacion" width="100%" src="https://www.youtube.com/embed/'.$infoproducto["multimedia"].'?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
				</div';
				}

			 ?>
		

			<!--================================================
			             VISOR DE PRODUCTOS VIRTUALES                     
			=================================================-->
			<?php
				if ($infoproducto["tipo"]=="fisico") {
					echo '<div class="col-md-7 col-sm-6 col-xs-12">';
				}else{
					echo '<div class="col-sm-6 col-xs-12">';
				}
			 ?>


			<!--================================================
			             LUPA                        
			=================================================-->
		

				<div class="col-xs-6">
					<h6><a href="javascript:history.back()" class="text-muted"> <i class="fa fa-reply"> </i> Continuar comprando</a></h6>
				</div>
				<!-- Compartir en redes sociales -->
				<div class="col-xs-6">
					<h6><a class="dropdown-toggle pull-right text-muted" data-toggle="dropdown" href="#"><i class="fa fa-plus"> Compartir</i></a>
						<ul class="dropdown-menu pull-right compartirRedes">
							<li>
								<p class="btnFacebook"><i class="fa fa-facebook"></i> Facebook</p>
							</li>
							<li>
								<p class="btnGoogle"><i class="fa fa-google"></i> Google</p>
							</li>
						</ul>
					</h6>
				</div>

				<div class="clearfix"></div>

				<!--================================================
			             ESPACIO PARA EL PRODUCTO                        
			    =================================================-->

			    <?php 
			    /*----------  TITULO DEL PRODUCTO  ----------*/
			    
			    	//Si no trae oferta
				    if($infoproducto["oferta"]==0){

				    	// Si no es nuevo
				    	 if($infoproducto["nuevo"]==0){
					    	 	echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';
					    	 }else{
					    	 	//si es nuevo
							    	echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
							    	<br>
							    		<small>
							    			<span class="label label-warning">NUEVO</span>
							    		</small>
							    	</h1>';
					    	 }
				    	
				    }else{
				    	if($infoproducto["nuevo"]==0){
				    		//si trae oferta
					    	echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
					    	<br>
					    		<small>
					    			<span class="label label-warning">'.$infoproducto["descuentoOferta"].' % OFF</span>
					    		</small>
					    	</h1>';
				    	}else{
				    		//si trae oferta y no es nuevo
					    	echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'
					    	<br>
					    		<small>
					    			<span class="label label-warning">NUEVO</span>
					    			<span class="label label-warning">'.$infoproducto["descuentoOferta"].' % OFF</span>
					    		</small>
					    	</h1>';
					    	}
				    	

				    }

				    /*----------  PRECIO DEL PRODUCTO  ----------*/
				    // Si es gratis
				    if($infoproducto["precio"]==0){
				    	echo '<h2 class="text-muted">GRATIS</h2>';
				    }else{
				    	// si no es gratis
				    	//Si no trae oferta
				    	if($infoproducto["oferta"]==0){
				    			echo '<h2 class="text-muted">USD $'.$infoproducto["precio"].'</h2>';
				    		}else{
				    			// Si no es gratis y trae oferta
				    			echo '<h2 class="text-muted">
				    			<span>
				    				<strong class="oferta">USD $'.$infoproducto["precio"].'</strong>
				    			</span>

				    			<span>
				    				USD $'.$infoproducto["precioOferta"].'
				    			</span>
				    				
				    			</h2>';

				    	}
				    }


				    /*----------  DESCRIPCION DEL PRODUCTO  ----------*/
				    echo '<p>'.$infoproducto["descripcion"].'</p>';
			     ?>

			        <!--  /*---------- CARACTERISTICAS DEL PRODUCTO   ----------*/ -->
				    <hr>
				    <hr>
					<div class="form-group row">
						<?php 
							// Si tiene detalles
							if($infoproducto["detalles"]!=null){
								// Si es fisico

								$detalles=json_decode($infoproducto["detalles"],true);
									// var_dump($detalles);
								if($infoproducto["tipo"]=="fisico"){
									
									//Si tiene Talla
									if($detalles["Talla"]==!null){
										echo '<div class="col-md-3 col-xs-12">
												<select class="form-control seleccionarDetalle" id="seleccionarTalla">
													<option value="">Talla</option>';
													//Recorriendo la variable tall
													for ($i=0; $i <count($detalles["Talla"]) ; $i++) { 
														echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';
													}
												echo '</select>
											 </div>';
									}

									//Si tiene Color
									if($detalles["Color"]==!null){
										echo '<div class="col-md-3 col-xs-12">
												<select class="form-control seleccionarDetalle" id="seleccionarColor">
													<option value="">Color</option>';
													//Recorriendo la variable tall
													for ($i=0; $i <count($detalles["Color"]) ; $i++) { 
														echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';
													}
												echo '</select>
											 </div>';
									}


									//Si tiene Marca
									if($detalles["Marca"]==!null){
										echo '<div class="col-md-3 col-xs-12">
												<select class="form-control seleccionarDetalle" id="seleccionarMarca">
													<option value="">Marca</option>';
													//Recorriendo la variable tall
													for ($i=0; $i <count($detalles["Marca"]) ; $i++) { 
														echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';
													}
												echo '</select>
											 </div>';
									}





								// Si es virtual
								}else{
									echo '<div class="col-xs-12">
										<li>
											<i style="margin-right:10px" class="fa fa-play-circle"></i>'.$detalles["Clases"].'
										</li>
										<li>
											<i style="margin-right:10px" class="fa fa-clock-o"></i>'.$detalles["Tiempo"].'
										</li>
										<li>
											<i style="margin-right:10px" class="fa fa-check-circle"></i>'.$detalles["Nivel"].'
										</li>
										<li>
											<i style="margin-right:10px" class="fa fa-info-circle"></i>'.$detalles["Acceso"].'
										</li>
										<li>
											<i style="margin-right:10px" class="fa fa-desktop"></i>'.$detalles["Dispositivo"].'
										</li>
										<li>
											<i style="margin-right:10px" class="fa fa-trophy"></i>'.$detalles["Certificado"].'
										</li>

									</div>';
								}

							}

							/*----------  ENTREGA  ----------*/
							// Si entrega de producto es de 0 dias
							if($infoproducto["entrega"]==0){

									// Si el producto es gratis
									if($infoproducto["precio"]==0){

										echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
										<hr>
										<span class="label label-default" style="font-weight:100">
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
											Entrega inmediata |
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventasGratis"].' inscritos |
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas 
										</span>
									</h4>';

									echo '<h4 class="col-lg-0 col-md-0 col-xs-12">
										<hr>
										<small>
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
											Entrega inmediata <br>
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventasGratis"].' inscritos <br>
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas 
										</small>
									</h4>';

									}else{
										//Son de pago
										echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
										<hr>
										<span class="label label-default" style="font-weight:100">
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
											Entrega inmediata |
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventas"].' ventas |
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas 
										</span>
									</h4>';

									echo '<h4 class="col-lg-0 col-md-0 col-xs-12">
										<hr>
										<small">
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
											Entrega inmediata <br>
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventas"].' ventas <br>
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas 
										</small>
									</h4>';


									}
								
							// Si es producto no es de 0 dias o es fisico
							}else{

									//Si el precio es 0 o es producto gratis
									if($infoproducto["precio"]==0){
										echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
											<hr>
											<small class="label label-default" style="font-weight:100">
												<i class="fa fa-clock-o" style="margin-right:5px"></i>
										     	'.$infoproducto["entrega"].' días hábiles para la entrega |
												<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
												'.$infoproducto["ventasGratis"].' solicitudes |
												<i class="fa fa-eye" style="margin:0px 5px"></i>
												visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas 
											</small>
										</h4>';


										echo '<h4 class="col-lg-0 col-md-0 col-xs-12">
											<hr>
											<small">
												<i class="fa fa-clock-o" style="margin-right:5px"></i>
										     	'.$infoproducto["entrega"].' días hábiles para la entrega <br>
												<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
												'.$infoproducto["ventasGratis"].' solicitudes <br>
												<i class="fa fa-eye" style="margin:0px 5px"></i>
												visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas 
											</small>
										</h4>';
									}else{
										// esto es para responsive por eso aparecen 2 bloques
										echo '<h4 class="col-md-12 col-sm-0 col-xs-0">
										<hr>
										<span class="label label-default" style="font-weight:100">
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
									     	'.$infoproducto["entrega"].' días hábiles para la entrega |
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventas"].' ventas |
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas 
										</span>
									</h4>';


										echo '<h4 class="col-lg-0 col-md-0 col-xs-12">
										<hr>
										<small>
											<i class="fa fa-clock-o" style="margin-right:5px"></i>
											'.$infoproducto["entrega"].' días hábiles para la entrega <br>
											<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
											'.$infoproducto["ventas"].' ventas <br>
											<i class="fa fa-eye" style="margin:0px 5px"></i>
											visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas 
										</small>
									</h4>';
									}

			
							}

						 ?>	
					</div>


				<!-- /*----------  Botones de compra  ----------*/ -->
				<div class="row botonesCompra">
					<?php 
						//Si producto es gratis
						if ($infoproducto["precio"]==0) {

							echo '<div class="col-md-6 col-xs-12">';

								if($infoproducto["tipo"]=="virtual"){
										echo '<button class="btn btn-default btn-block btn-lg backColor">Acceder ahora</button>';
									}else{
										echo '<button class="btn btn-default btn-block btn-lg backColor">Solicitar ahora</button>';
								}

							echo '</div>';

						}else{

							// Si es virtual, si necesito los botones de compra
							if($infoproducto["tipo"]=="virtual"){
									// Si no es gratis
								echo '<div class="col-md-6 col-xs-12">
									<button class="btn btn-default btn-block btn-lg"><small>Comprar ahora</small></button>
								</div>
								<div class="col-md-6 col-xs-12">
									<button class="btn btn-default btn-block btn-lg backColor"><i class="fa fa-shopping-cart col-md-0"></i> Agregar al carrito</button>
								</div>';
							}else{
								// Si es fisico, solo botones de Agregar al carrito
								echo '<div class="col-md-6 col-xs-12">
									<button class="btn btn-default btn-block btn-lg backColor"><i class="fa fa-shopping-cart"></i> Agregar al carrito</button>
								</div>';
							}
						
						}
					 ?>
				
				</div>

				<!--==========================
				=            Lupa            =
				===========================-->

				<figure class="lupa">
					<img src="" alt="">
				</figure>
			</div>
		</div>
	<!--=================================
	=            Comenterios            =
	==================================-->
	<br>

	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active"><a>Comentarios</a></li>
			<li><a href="">Ver más</a></li>
			<li class="pull-right">
				<a href="" class="text-muted">Promedio de calificación: 3.5 | 
					<i class="fa fa-star text-success"></i>
					<i class="fa fa-star text-success"></i>
					<i class="fa fa-star-half-o text-success"></i>
					<i class="fa fa-star-o text-success"></i>

				</a>
			</li>
		</ul>	
		<br>

	</div>

	<div class="row comentarios">
		<div class="panel-group col-md-3 col-sm-6 col-xs-12">
			<div class="panel panel-default">
					<div class="panel-heading text-uppercase">
						Juan Perez
						<span class="text-right">
							<img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%" alt="">
						</span>
					</div>

					<div class="panel-body"><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis quaerat, nemo est quos provident ad perferendis, commodi vero! Perspiciatis ea velit aspernatur voluptatem repellendus. Praesentium voluptate blanditiis, cupiditate vel assumenda.</small></div>

					<div class="panel-footer">
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star-half-o text-success"></i>
						<i class="fa fa-star-o text-success"></i>
					</div>
				</div>
			</div>


			<div class="panel-group col-md-3 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-uppercase">
						Juan Perez
						<span class="text-right">
							<img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%" alt="">
						</span>
					</div>

					<div class="panel-body"><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis quaerat, nemo est quos provident ad perferendis, commodi vero! Perspiciatis ea velit aspernatur voluptatem repellendus. Praesentium voluptate blanditiis, cupiditate vel assumenda.</small></div>

					<div class="panel-footer">
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star-half-o text-success"></i>
						<i class="fa fa-star-o text-success"></i>
					</div>
				</div>
			</div>

			<div class="panel-group col-md-3 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-uppercase">
						Juan Perez
						<span class="text-right">
							<img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%" alt="">
						</span>
					</div>

					<div class="panel-body"><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis quaerat, nemo est quos provident ad perferendis, commodi vero! Perspiciatis ea velit aspernatur voluptatem repellendus. Praesentium voluptate blanditiis, cupiditate vel assumenda.</small></div>

					<div class="panel-footer">
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star-half-o text-success"></i>
						<i class="fa fa-star-o text-success"></i>
					</div>
				</div>
			</div>

			<div class="panel-group col-md-3 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-uppercase">
						Juan Perez
						<span class="text-right">
							<img class="img-circle" src="<?php echo $url; ?>vistas/img/usuarios/40/944.jpg" width="20%" alt="">
						</span>
					</div>

					<div class="panel-body"><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis quaerat, nemo est quos provident ad perferendis, commodi vero! Perspiciatis ea velit aspernatur voluptatem repellendus. Praesentium voluptate blanditiis, cupiditate vel assumenda.</small></div>

					<div class="panel-footer">
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star text-success"></i>
						<i class="fa fa-star-half-o text-success"></i>
						<i class="fa fa-star-o text-success"></i>
					</div>
				</div>
			</div>
		</div>
		<hr>
	</div>
	<!-- <hr> -->
</div>
<!-- <hr> -->
</div>

<!--============================================
=            Productos relacionados            =
=============================================-->
<div class="container-fluid productos">
	<div class="container">
		<div class="row">
		  <div class="col-xs-12 tituloDestacado">

		  <div class="col-sm-6 col-xs-12">
			<h1><small>Productos relacionados</small></h1>
		</div>
		
		<div class="col-sm-6 col-xs-12"> 
			<?php 
				$item="id";
				$valor=$infoproducto["id_subcategoria"];
				$rutaArticuloDestacado=ControladorProductos::ctrMostrarSubcategorias($item, $valor);
				// var_dump($rutaArticuloDestacado[0]["ruta"]);
				echo'<a href="'.$rutaArticuloDestacado[0]["ruta"].'">
						<button class="btn btn-default backColor pull-right">
							VER MÁS<span class="fa fa-chevron-right"></span>
						</button>
					</a>';
			 ?>
		
		  </div>				
		</div>

		<div class="clearfix"></div>
		<!-- <hr> -->
	</div>
	<hr>


	<?php 
		$ordenar="";
		$item="id_subcategoria";
		$valor=$infoproducto["id_subcategoria"];
		$base=0;
		$tope=4;
		$modo="Rand()";
		$relacionados =ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
		// var_dump($relacionados);

		// si no hay productos relacionados
		if(!$relacionados){
			echo '<div class="col-xs-12 error404">
				<h1><small>¡Oops!</small></h1>
				<h2><small>No hay productos relacionados</small></h2>
			</div>';	
			// Si los hay, propductos relacionados	
		}else{
			echo'<ul class="grid0">';

			//variable que recorre la cantidad de veces (3) de acuerdi a la variable relacionados
			foreach ($relacionados as $key => $value) {
				echo '<li class="col-md-3 col-sm-6 col-xs-12">
					<figure>
						<a href="'.$url.$value['ruta'].'" class="pixelProducto">
							<img src="'.$servidor.$value['portada'].'" class="img-responsive" alt="">
						</a>
					</figure>
					<h4>
						<small>
							<a href="'.$url.$value['ruta'].'" class="pixelProducto">'.$value['titulo'].' <br><span style="color:rgba(0,0,0,0)">-</span>';
							// !0 significa producto nuevo
								if($value["nuevo"]!=1){
									echo '<span class="label label-warning fontSize">Nuevo</span> ';
								}
							//1 Significa oferta
								if($value['oferta']==1){
									echo '<span class="label label-warning fontSize">'.$value['descuentoOferta'].' % OFF</span>';
								}

							echo '</a>
						</small>
					</h4>
					<div class="col-xs-6 precio">';
						if($value['precio']==0){
							echo '<h2><small>GRATIS</small></h2>';
						}else{
							//Si tiene alguna oferta

							if($value['oferta']!=0){
								echo '<h2>
										<small>
											<strong class="oferta">USD $ '.$value['precio'].'</strong>
										</small>
										<small>$'.$value['precioOferta'].'</small>
									</h2>';	

							}else{
								echo '<h2><small> USD $'.$value['precio'].'</small></h2>';
							}
							
						}
					echo '</div>
					<div class="col-xs-6 enlaces">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value['id'].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
								<i class="fa fa-heart" aria-hidden="true"></i>
							</button>';

							if($value['tipo']=="virtual" && $value["precio"]!=0 ){
							
							//Si tiene oferta
							if($value['oferta']!=0){
									echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value['id'].'" imagen="'.$servidor.$value['portada'].'" titulo="'.$value['titulo'].'" precio="'.$value['precioOferta'].'" tipo="'.$value['tipo'].'" peso="'.$value['peso'].'" data-toggle="tooltip" title="Agregar al carrito de compras">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
									</button>';
								}else{
								// si no tiene oferta
										echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value['id'].'" imagen="'.$servidor.$value['portada'].'" titulo="'.$value['titulo'].'" precio="'.$value['precio'].'" tipo="'.$value['tipo'].'" peso="'.$value['peso'].'" data-toggle="tooltip" title="Agregar al carrito de compras">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
									</button>';
								}

						
							}

							echo'<a href="'.$url.$value['ruta'].'" class="pixelProducto">
								<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i>
								</button>
							</a>						
						</div>
					</div>
				</li>';
				} //Cierre Foreach

			echo '</ul>';
		} //Cierre else

	?>

	</div>
</div>