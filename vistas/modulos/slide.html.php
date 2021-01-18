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
			<!-- Slide 1 -->
			<li>
				<img src="http://localhost/backend/vistas/img/slide/default/back_default.jpg" alt="">
				<div class="slideOpciones slideOpcion1">
					<img src="http://localhost/backend/vistas/img/slide/slide1/calzado.png" alt="" class="imgProducto" style="top: 15%; right: 10%; width: 45%;">
					<div class="textosSlide" style="top: 20%; left: 10%; width: 40%;">
						<h1 style="color: #333;">Lorem Ipsum</h1>
						<h2 style="color:#777;">Loem Ipsuum sit</h2>
						<h3 style="color:#888;">Lorem Ipsum sit</h3>
						<a href="#">
							<button class="btn btn-default backColor text-uppercase">VER PRODUCTO <span class="fa fa-chevron-right"></span>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- Slide 2 -->
			<li>
				<img src="http://localhost/backend/vistas/img/slide/default/back_default.jpg" alt="">
				<div class="slideOpciones slideOpcion2">
					<img src="http://localhost/backend/vistas/img/slide/slide2/curso.png" alt="" class="imgProducto" style="top: 5%; left: 15%; width: 25%;">
					<div class="textosSlide" style="top: 20%; right: 10%; width: 40%;">
						<h1 style="color: #333;">Lorem Ipsum</h1>
						<h2 style="color:#777;">Loem Ipsuum sit</h2>
						<h3 style="color:#888;">Lorem Ipsum sit</h3>
						<a href="#">
							<button class="btn btn-default backColor text-uppercase">VER PRODUCTO <span class="fa fa-chevron-right"></span>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- Slide 3 -->
			<li>
				<img src="http://localhost/backend/vistas/img/slide/slide3/fondo2.jpg" alt="">
				<div class="slideOpciones slideOpcion2">
					<img src="http://localhost/backend/vistas/img/slide/slide3/iphone.png" alt="" class="imgProducto" style="top: 5%; left: 15%; width: 25%;">
					<div class="textosSlide" style="top: 20%; right: 10%; width: 40%;">
						<h1 style="color: #333;">Lorem Ipsum</h1>
						<h2 style="color:#777;">Loem Ipsuum sit</h2>
						<h3 style="color:#888;">Lorem Ipsum sit</h3>
						<a href="#">
							<button class="btn btn-default backColor text-uppercase">VER PRODUCTO <span class="fa fa-chevron-right"></span>
							</button>
						</a>
					</div>
				</div>
			</li>

			<!-- Slide 4 -->
			<li>
				<img src="http://localhost/backend/vistas/img/slide/slide4/fondo3.jpg" alt="">
				<div class="slideOpciones slideOpcion1">
					<img src="" alt="" class="imgProducto" style="top: 5%; right: 15%; width: 25%;">
					<div class="textosSlide" style="top: 20%; left: 10%; width: 40%;">
						<h1 style="color: #333;">Lorem Ipsum</h1>
						<h2 style="color:#777;">Loem Ipsuum sit</h2>
						<h3 style="color:#888;">Lorem Ipsum sit</h3>
						<a href="#">
							<button class="btn btn-default backColor text-uppercase">VER PRODUCTO <span class="fa fa-chevron-right"></span>
							</button>
						</a>
					</div>
				</div>
			</li>
		</ul>	
		<!--================================
		=            PAGINACION            =
		=================================-->
		
		<ol id="paginacion">
			<li item="1"><span class="fa fa-circle"></span></li>
			<li item="2"><span class="fa fa-circle"></span></li>
			<li item="3"><span class="fa fa-circle"></span></li>
			<li item="4"><span class="fa fa-circle"></span></li>
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