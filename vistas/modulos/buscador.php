

<!--=====================================
BARRA PRODUCTOS GRATIS
======================================-->
<div class="container-fluid well well-sm barraProductos">
	<div class="container">
		<div class="row">
			<div  class="col-sm-6 col-xs-12">
				<div class="btn-group">
					<button type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Ordenar Productos <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<?php echo '
							<li><a href="'.$url.$rutas[0].'/1/recientes/'.$rutas[3].'">Mas recientes</a></li>
							<li><a href="'.$url.$rutas[0].'/1/antiguos/'.$rutas[3].'">Mas antiguos</a></li>'; 
						?>
					
					</ul>
				</div>
			</div>

			<div class="col-sm-6 col-xs-12 organizarProductos">
				<div class="btn-group pull-right">
					<button class="btn btn-default btnGrid" id="btnGrid0" type="button">
						<i class="fa fa-th" aria-hidden="true"></i>
						<!-- <span class="visible-lg visible-md visible-sm pull-right"> GRID</span> -->
						<!-- Escondido en dispositivos moviles con col-xs-0 -->
						<span class="col-xs-0 pull-right"> GRID</span>
					</button>
					<button class="btn btn-default btnList" id="btnList0" type="button">
						<i class="fa fa-list" aria-hidden="true"></i>
						<!-- <span class="visible-lg visible-md visible-sm pull-right"> GRID</span> -->
						<!-- Escondido en dispositivos moviles con col-xs-0 -->
						<span class="col-xs-0 pull-right"> LIST</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--=====================================
LISTA DE PRODUCTOS
======================================-->

<div class="container-fluid productos">
	<div class="container">
		<div class="row">
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				<li><a href="<?php echo $url ?>">Inicio</a></li>
				<!-- .paginaActiva nos manda a plantilla .js para modificar su estructura -->
				<li class="active pagActiva"><?php echo $rutas[0]; ?></li>
			</ul>

				<?php 
				/*----------  PAGINACION  ----------*/
				if(isset($rutas[1]) ){
					//Variable de sesion para mantener el orden de los productos de acuerdo al valor ASC O DESC seleccionado
					//$_SESSION["ordenar"]="DESC";

					// Si la url en nivel 3 existe
					if(isset($rutas[2])){
						//Si la ruta nivel 3 es igual "antiguos"
						if($rutas[2]=="antiguos"){
							$modo="ASC";
							$_SESSION["ordenar"]="ASC";
						}else{
							$modo="DESC";
							$_SESSION["ordenar"]="DESC";
						}
					}else{
						//Sino dejalo por defecto
						$modo=$_SESSION["ordenar"];
					}

					$base=($rutas[1]-1)*12; //Para traer un inicio
			    	$tope=12; //Para la paginacion termina en 12 [muestra solo 12 registros]
			    	//de 0 a 12 0 de 13-24...
			    	// $base puede ser inicio
			    	// $tope puede ser fin
				}else{
					$rutas[1]=1;
					$base=0; //Para la paginacion inicia en 0
			    	$tope=12; //Para la paginacion termina en 12 [muestra solo 12 registros]
			    	$modo="DESC";//Si no estoy trabajando con paginacion ponlo por defecto DESC
				}



				/*----------  PRODUCTOS POR BUSQUEDA ----------*/

				// $productos=null;
				// $listaProductos=null;
				$ordenar ="id";

				if(isset($rutas[3])){

				$busqueda = $rutas[3];//Para hacer busqueda en bd
				$productos =ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
				//var_dump(count($productos)); //Cuenta cuantos trae para paginar
				$listaProductos=ControladorProductos::ctrListarProductosBusqueda($busqueda);
				//var_dump(count($listaProductos)); //para paginacion
					
				}
			


				if (!$productos) {
					echo '<div class="col-xs-12 error404 text-center">
						<h1><small>¡Oops!</small></h1>
						<h2>Aún no hay productos en esta sección</h2>
					</div>';

				}else{
					//Si encuentran productos
					echo '<ul class="grid0">';

					//variable que recorre la cantidad de veces (3) de acuerdi a la variable titulosModulos
					foreach ($productos as $key => $value) {
						echo '<li class="col-md-3 col-sm-6 col-xs-12">
							<figure>
								<a href="'.$value['ruta'].'" class="pixelProducto">
									<img src="'.$servidor.$value['portada'].'" class="img-responsive" alt="">
								</a>
							</figure>
							'.$value['id'].'
							<h4>
								<small>
									<a href="'.$value['ruta'].'" class="pixelProducto">'.$value['titulo'].' <br><span style="color:rgba(0,0,0,0)">-</span>';
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

									echo'<a href="'.$value['ruta'].'" class="pixelProducto">
										<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i>
										</button>
									</a>						
								</div>
							</div>
						</li>';
					}

				echo '</ul>



				<ul class="list0" style="display: none;">';

				foreach ($productos as $key => $value) {
				
				echo'<li class="col-xs-12">
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

							<figure>
								<a href="'.$value['ruta'].'" class="pixelProducto">
									<img src="'.$servidor.$value['portada'].'" class="img-responsive" alt="">
								</a>
							</figure>

						</div>
			
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							<h1>
								<small>
									<a href="'.$value['ruta'].'" class="pixelProducto">
										<a href="'.$value['ruta'].'" class="pixelProducto">
										'.$value['titulo'].'<br>';
										// !0 significa producto nuevo
										if($value["nuevo"]!=1){
											echo '<span class="label label-warning">Nuevo</span> ';
										}
									//1 Significa oferta
										if($value['oferta']==1){
											echo '<span class="label label-warning">'.$value['descuentoOferta'].' % OFF</span>';
										}

									echo'</a>
								</small>
							</h1>
							<p class="text-muted">'.$value['titular'].'</p>';


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
							
							echo'<div class="btn-group pull-left enlaces">
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

								
								echo'<a href="'.$value['ruta'].'" class="pixelProducto">
									<button type="button" class="btn btn-default btn-xs deseos" data-toggle="tooltip" title="Ver producto"><i class="fa fa-eye" aria-hidden="true"></i>
									</button>
								</a>						
							</div>
						</div>
						<div class="col-xs-12"><hr></div>
					</li>';
				}

			echo'<div class="col-xs-12">
				<hr>
			</div>
		</ul>';
	}

?>


<!-- paginacion -->
<div class="clearfix"></div> <!--para colocar los botones en la parte de abajo en cuanto al timo registro-->
		<center>

			<?php 	
			//Si $listaProductos es diferente a 0 es porque vamos a usar la paginacion
			if(count($listaProductos)!=0){
			  $pagProductos= ceil(count($listaProductos)/12);//El total de productos entre 12; ceil para redondear
			  //var_dump($pagProductos); //

			/*----------  BOTONES DE LAS 4 PAGINAS Y ULTIMA PAGINA  ----------*/
			
			  //Si necesito mas de 4 paginas o botones de navegacion
			  if($pagProductos>4){

			  	if($rutas[1]==1){
				  	echo '<ul class="pagination">';
				  		//Quiero que me muestre solo 4 botones de navegacion
				  		for ($i=1; $i <= 4; $i++) { 
				  			// rutas[0]=buscador/numero de pagina/$rutas[2]=antiguos/$rutas[3]=parametro de busqueda
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

				  		}

				  		echo '<li class="disabled"><a>...</a></li>
				  		      <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
				  		      <li><a href="'.$url.$rutas[0].'/2/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
				  		
				 	 	echo'</ul';
				  }	

				
				  /*----------  BOTONES DE LA  MITAD HACIA ABAJO O el grupo de 0 a 12 paginas ----------*/
				  else if($rutas[1] != $pagProductos && 
				  		   $rutas[1] !=1 &&
				  		   $rutas[1] < ($pagProductos/2) &&
				  		   $rutas[1] < ($pagProductos-3)
				  		){
				  		$numPaginaActual =$rutas[1];//Pagina actual

				  		echo '<ul class="pagination">
				  		 <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';

				  		//Quiero que me muestre solo 4 botones de navegacion
				  		for ($i=$numPaginaActual; $i <= ($numPaginaActual+3); $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

				  		}

				  		echo '<li class="disabled"><a>...</a></li>
				  		      <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
				  		      <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual+1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
				  		
				 	 	echo'</ul';
				  }

				  /*----------  BOTONES DE 12 EN ADELANTE a 20----------*/
				  else if($rutas[1] != $pagProductos && 
				  		   $rutas[1] !=1 &&
				  		   $rutas[1] >= ($pagProductos/2) &&
				  		   $rutas[1] < ($pagProductos-3)
				  		){

				  	    $numPaginaActual =$rutas[1];//Pagina actual
				  		echo '<ul class="pagination">
				  	      <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
				  	      <li class="disabled"><a>...</a></li>';
				  		//Quiero que me muestre solo 4 botones de navegacion

				  		for ($i=$numPaginaActual; $i <= ($numPaginaActual+3); $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

				  		}		

				 	 	echo'<li><a href="'.$url.$rutas[0].'/'.($numPaginaActual+1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				 	 	</ul';


				  }
				   
				   /*----------   Botones de las siguientes 4 paginas de la pagina y la primera pagina  ----------*/
				   
				  else{
				  	$numPaginaActual =$rutas[1];//Pagina actual
				  	echo '<ul class="pagination">
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'/'.$rutas[2].'/'.$rutas[3].'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
				  	      <li class="disabled"><a>...</a></li>';
				  		//Quiero que me muestre solo 4 botones de navegacion

				  		for ($i=($pagProductos-3); $i <= $pagProductos; $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

				  		}				  		
				 	 	echo'</ul';
				 	 }

				  
			  //Si necesito menos de 4 paginas o botones de navegacion
			  }else{

			  	echo '<ul class="pagination">';
			  		//Por ejemplo, Si el resultado de $pagProductos/12 == 2, solo sería dos botones de paginacion
			  		for ($i=1; $i <= $pagProductos; $i++) { 
			  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

			  		}

			  	echo'</ul';	
			  }

			}

		 ?>

			
		</center>
</div>
</div>
</div>

