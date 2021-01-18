<!--===============================
=            SLIDESHOW            =
================================-->
<!-- ctrl+alt+f formatea archivos json -->
<div class="container-fluid" id="slide">
	<div class="row">
		<!--==================================
		=            DIAPOSITIVAS            =
		===================================-->
		<ul>
			<?php 
				$servidor=Ruta::ctrRutaServidor();
				$slide =ControladorSlide::ctrMostrarSlide();
				// var_dump($slide);
				foreach ($slide as $key => $value) {
					//Estilo de imagen del producto
					$estiloImgProducto = json_decode($value["estiloImgProducto"],true);
					//Estilo de texto slide
					$estiloTextoSlide = json_decode($value["estiloTextoSlide"],true);
					// Estilo headings
					$titulo1 = json_decode($value["titulo1"],true);
					$titulo2 = json_decode($value["titulo2"],true);
					$titulo3 = json_decode($value["titulo3"],true);

					echo '<li>
							<img src="'.$servidor.$value["imgFondo"].'" alt="">
							<div class="slideOpciones '.$value["tipoSlide"].'">';

							// Si tiene imagen de producto
							if($value["imgProducto"]!=""){
								echo'<img src="'.$servidor.$value["imgProducto"].'" alt="" class="imgProducto" style="top: '.$estiloImgProducto["top"].'; right: '.$estiloImgProducto["right"].'; width: '.$estiloImgProducto["width"].'; left: '.$estiloImgProducto["left"].'">';
							}							

							echo '<div class="textosSlide" style="top: '.$estiloTextoSlide["top"].'; left: '.$estiloTextoSlide["left"].'; width: '.$estiloTextoSlide["width"].'; right: '.$estiloTextoSlide["right"].'">
									<h1 style="color: '.$titulo1["color"].';">'.$titulo1["texto"].'</h1>
									<h2 style="color: '.$titulo2["color"].';">'.$titulo2["texto"].'</h2>
									<h3 style="color: '.$titulo3["color"].';">'.$titulo3["texto"].'</h3>
									<a href="'.$value["url"].'">
										'.$value["boton"].'
									</a>
								</div>
							</div>
						</li>';	
				}
				
			 ?>			
			

		</ul>	
		<!--================================
		=            PAGINACION            =
		=================================-->		
		<ol id="paginacion">
			<?php 
			// Cuandos datos me trae side? para paginacion dinamica
			// var_dump(count($slide));
				// Mientras i sea menos que la cantidad que trae en bd incrementa i
				for($i=1; $i<=count($slide); $i++){
					// el indice de item sera i
					echo '<li item="'.$i.'"><span class="fa fa-circle"></span></li>';
				}

		 	?>			
		</ol>		
		
		<!--=============================
		=            FLECHAS            =
		==============================-->
		<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>							
		<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>							
		
		
	</div>
</div>

<center>
	<button id="btnSlide" class="backColor">
		<i class="fa fa-angle-up"></i>
	</button>
</center>