<?php $servidor=Ruta::ctrRutaServidor(); ?>
<?php $url = Ruta::ctrRuta(); ?>
<!--=====================================
BANNER
======================================-->
<?php 
/*----------  BANNER  ----------*/

  $ruta=$rutas[0]; 
  $banner=ControladorProductos::ctrMostrarBanner($ruta);
   //var_dump($banner);



if($banner!=null && is_array($banner)){
	  // Pasamos de string a arrays
  $titulo1=json_decode($banner["titulo1"], true);//Cada $var tiene 3 valores distintos en cada uno
  $titulo2=json_decode($banner["titulo2"], true);
  $titulo3=json_decode($banner["titulo3"], true);
  
  echo '<figure class="banner">
			<img src="'.$servidor.$banner["img"].'" alt="" class="img-responsive" width="100%">

			<div class="textoBanner '.$banner["estilo"].'">
				<h1 style="color: '.$titulo1["color"].'">'.$titulo1["texto"].'</h1>
				<h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>
				<h3 style="color: '.$titulo3["color"].'">'.$titulo3["texto"].'</h3>
			</div>
		</figure>
		';
}
?>

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
							<li><a href="'.$url.$rutas[0].'/1/recientes">Mas recientes</a></li>
							<li><a href="'.$url.$rutas[0].'/1/antiguos">Mas antiguos</a></li>'; 
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
						if(isset($_SESSION["ordenar"])){
							$modo=$_SESSION["ordenar"];
						}else{
							$modo=$_SESSION["ordenar"];
						}
					}

					// Esto Aplica cuando ya da clic en el boton de la página 2 en adelante por ejemplo
					// http://localhost/frontend/desarrollo-web[0]/2[1]
					// base=(rutas[1] que es igual a = 2-1)*12=12 y mostrara de la pagina 
						//13,14,15,16,17,18,19,20,21,22,23,24
				    //tope=1, 2, 3,  4,5,  6, 7, 8, 9,10,11,12
					$base=($rutas[1]-1)*12; //Para traer un inicio o un bloque dinámico de productos con un tope de 12 elementos
			    	$tope=12; //Para la paginacion termina en 12 [muestra solo 12 registros]
			    	//de 0 a 12 0 de 13-24...
			    	// $base puede ser inicio del rango hasta el fin
			    	// $tope es el rango de registros
				}else{
					// Esto Aplica cuando ya da clic en el boton de la página 1
					$rutas[1]=1;//Url con valor 1
					$base=0; //Para la paginacion inicia en 0
			    	$tope=12; //Para la paginacion termina en 12 [muestra solo 12 registros]
			    	$modo="DESC";//Si no estoy trabajando con paginacion ponlo por defecto DESC
				}

				/*----------  PRODUCTOS DESTACADOS  ----------*/
				// Validando url amigable
				if($rutas[0]== "articulos-gratis"){

					$item2="precio";
					$valor2=0;
					$ordenar="id";//ordenar por precio

				}else if($rutas[0]== "lo-mas-vendido"){

					$item2=null;
					$valor2=null;
					$ordenar="ventas";//Ordenar por ventas

				}else if($rutas[0]== "lo-mas-visto"){

					$item2=null;
					$valor2=null;
					$ordenar="vistas"; //ordenar por vistas

				}else{
					/*----------  CATEGORIAS  ----------*/
					// De acuerdo a lo que se encuentre en la url o cuando el user entra a productos.php
					$ordenar="id"; //ordenar por id las consltas
					$item1 = "ruta" ;//Campo ruta en bd Categoria
					$valor1 =$rutas[0];//Lo que venga de la url

					//Obtenemos categorias
					$categoria =ControladorProductos::ctrMostrarCategorias($item1, $valor1);

					/*----------  SUBCATEGORIAS  ----------*/

					// var_dump($categoria);
					//Si no encuentras nada de coincidencias en tabla categorias con la url
					if(!$categoria){
						// consultalo en subCategorias
						$subCategoria=ControladorProductos::ctrMostrarSubCategorias($item1, $valor1);
						//var_dump($subCategoria);
						//var_dump($subCategoria[0]["id"]); //muestra el id de la subcategoria
						$item2="id_subcategoria";
						$valor2=$subCategoria[0]["id"];
					}else{

						$item2="id_categoria";
						$valor2=$categoria["id"];
					}
				}


				/*----------  PRODUCTOS  ----------*/


			
				$productos =ControladorProductos::ctrMostrarProductos($ordenar, $item2, $valor2, $base, $tope, $modo);
				//var_dump(count($productos)); //Cuenta cuantos trae para paginar
				$listaProductos=ControladorProductos::ctrListarProductos($ordenar, $item2, $valor2);
				//var_dump(count($listaProductos)); //para paginacion
					

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
								<a href="'.$url.$value['ruta'].'" class="pixelProducto">
									<img src="'.$servidor.$value['portada'].'" class="img-responsive" alt="">
								</a>
							</figure>
							'.$value['id'].'
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
					}

				echo '</ul>



				<ul class="list0" style="display: none;">';

				foreach ($productos as $key => $value) {
				
				echo'<li class="col-xs-12">
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">

							<figure>
								<a href="'.$url.$value['ruta'].'" class="pixelProducto">
									<img src="'.$servidor.$value['portada'].'" class="img-responsive" alt="">
								</a>
							</figure>

						</div>
			
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							<h1>
								<small>
										<a href="'.$url.$value['ruta'].'" class="pixelProducto">
										'.$value['titulo'].'<br>';
										// !0 significa producto nuevo
										if($value["nuevo"]!=0){
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

								
								echo'<a href="'.$url.$value['ruta'].'" class="pixelProducto">
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

			/*----------  BOTONES DE LAS 4 PRIMERAS PAGINAS Y ULTIMA PAGINA  ----------*/
			   // Botones 1,2,3,4...24 >
			  //Si necesito mas de 4 paginas o botones de navegacion
			  if($pagProductos>4){

			  	// Si $rutas[1]==1 o sea que va a ser de productos de 0 a 12 o mejor dicho si http://localhost/frontend/desarrollo-web[0]/1[1]
			  	if($rutas[1]==1){
				  	echo '<ul class="pagination">';
				  		//Quiero que me muestre solo 4 botones de navegacion
				  		for ($i=1; $i <= 4; $i++) { 
				  			// rutas[0]=pagina donde me encuentro
				  			//$i=numero de pagina a azanzar
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

				  		}
				  		// pagProductos=fin del producto o total
				  		// por ser primera pagina, el href="'.$url.$rutas[0].'/2"> manda a la siguiente pagina o sea la 2
				  		echo '<li class="disabled"><a>...</a></li>
				  		      <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
				  		      <li><a href="'.$url.$rutas[0].'/2"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
				  		
				 	 	echo'</ul';
				  }	

				
				  /*----------  BOTONES DE LA PRIMERA MITAD DE BOTONES HACIA ABAJO (BOLOQUES DE 1 A 12)----------*/
				  // En este caso de 1 hasta el 12 (Considerando un total de total de paginas de 24)
				  // Si rutas[1] es diferente ultima pagina o $pagProductos=24
				  // Si rutas[1] es diferente de uno (si es difente pq este es pagina 2)
				  // Si rutas[1] es menor al  $pagProductos(24)/2=12
				  // Si rutas[1] es menor a $pagProductos(24)-3=21;
				  else if($rutas[1] != $pagProductos && 
				  		   $rutas[1] !=1 &&
				  		   $rutas[1] < ($pagProductos/2) &&
				  		   $rutas[1] < ($pagProductos-3)
				  		){
				  		// Esto definitivamente tiene que ser mayor a 1 pq es la pagina 2 en adelante
				  		$numPaginaActual =$rutas[1];//Pagina actual para poder usarla e ir a la pagina anterior

				  		echo '<ul class="pagination">
				  		 <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';

				  		//Ejemplo for($i=$numPaginaActual tiene valor de 8; $paginaActual<=($numPaginaActual+3) igual a 8,9,10,11;  $i=8,9,10,11)
				  		for ($i=$numPaginaActual; $i <= ($numPaginaActual+3); $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

				  		}

				  		echo '<li class="disabled"><a>...</a></li>
				  		      <li id="item'.$pagProductos.'"><a href="'.$url.$rutas[0].'/'.$pagProductos.'">'.$pagProductos.'</a></li>
				  		      <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual+1).'"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
				  		
				 	 	echo'</ul';
				  }


				  /*----------  BOTONES DE LA PRIMERA MITAD DE BOTONES HACIA ARRIBA (BOLOQUES DE 12 A 24)----------*/// Si rutas[1] 
				  //si es diferente ultima pagina o $pagProductos=24
				  // Si rutas[1] es diferente de uno (si es difente pq este es pagina 2)
				  //Si rutas[1] es mayor o igual a $pagProductos(24)/2=12 para que incluya el bloque 12
				  // Si rutas[1] es menor a $pagProductos(24)-3=21;
				  else if($rutas[1] != $pagProductos && 
				  		   $rutas[1] !=1 &&
				  		   $rutas[1] >= ($pagProductos/2) &&
				  		   $rutas[1] < ($pagProductos-3)
				  		){

				  	    $numPaginaActual =$rutas[1];//Pagina actual
				  		echo '<ul class="pagination">
				  	      <li><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
				  	      <li class="disabled"><a>...</a></li>';
				  		//Quiero que me muestre solo 4 botones de navegacion

				  		for ($i=$numPaginaActual; $i <= ($numPaginaActual+3); $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

				  		}		

				 	 	echo'<li><a href="'.$url.$rutas[0].'/'.($numPaginaActual+1).'"> <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
				 	 	</ul';


				  }
				   
				 /*----------  BOTONES DE LAS ULTIMAS 4 PAGINAS y LA PRIMERA PAGINA ----------*/
				 // Botones < 1,...,21,22,23,24 >
				  else{
				  	$numPaginaActual =$rutas[1];//Pagina actual =24
				  	echo '<ul class="pagination">
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/'.($numPaginaActual-1).'"> <i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
				  	      <li id="item1"><a href="'.$url.$rutas[0].'/1">1</a></li>
				  	      <li class="disabled"><a>...</a></li>';
				  		//Quiero que me muestre solo 4 botones de navegacion

				  		for ($i=($pagProductos-3); $i <= $pagProductos; $i++) { 
				  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

				  		}				  		
				 	 	echo'</ul';
				 	 }

				  
			  //Si necesito menos de 4 paginas o botones de navegacion
			  }else{

			  	echo '<ul class="pagination">';
			  		//Por ejemplo, Si el resultado de $pagProductos/12 == 2, solo sería dos botones de paginacion
			  		for ($i=1; $i <= $pagProductos; $i++) { 
			  			echo' <li id="item'.$i.'"><a href="'.$url.$rutas[0].'/'.$i.'">'.$i.'</a></li>';

			  		}

			  	echo'</ul';	
			  }

			}

		 ?>

			
		</center>
</div>
</div>
</div>

