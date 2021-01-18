/*==================================
=            VARIABLES            =
==================================*/
var item =0; //Para obtener los items de li
var itemPaginacion=$("#paginacion li"); //Para obtener la posicion seleccionada
var interrumpirCiclo =false;
// Para animacion
var imgProducto =$(".imgProducto");
var titulo1=$("#slide h1");
var titulo2=$("#slide h2");
var titulo3=$("#slide h3");
var btnVerProducto=$("#slide button");
// Para detener y ver el producto
var detenerIntervalo=false;
//Escconde slide
var toggle=false;

//Css dinamico dependiendo de la cantdidad de items que tenga
$("#slide ul li").css({"width":100/$("#slide ul li").length+"%"})
$("#slide ul").css({"width":$("#slide ul li").length*100+"%"})
/*==================================
ANIMACION INICIAL
==================================*/
$(imgProducto[item]).animate({"top":-10+"%","opacity":0}, 100);
$(imgProducto[item]).animate({"top":30+"px","opacity":1}, 600);

$(titulo1[item]).animate({"top":-10+"%","opacity":0}, 100);
$(titulo1[item]).animate({"top":30+"px","opacity":1}, 600);

$(titulo2[item]).animate({"top":-10+"%","opacity":0}, 100);
$(titulo2[item]).animate({"top":30+"px","opacity":1}, 600);

$(titulo3[item]).animate({"top":-10+"%","opacity":0}, 100);
$(titulo3[item]).animate({"top":30+"px","opacity":1}, 600);

$(btnVerProducto[item]).animate({"top":-10+"%","opacity":0}, 100);
$(btnVerProducto[item]).animate({"top":30+"px","opacity":1}, 600);

/*==================================
=            PAGINACION            =
==================================*/
// Toma el li del id paginacion y a darle clic el value de ese ite pasa a la variable item
$("#paginacion li").click(function (){
	item=$(this).attr("item")-1; //Restale -1 pq va iniciando de 0,-100,-200,-300 (que son la cantidad de opciones del slide) 
	// console.log(item);
	movimientoSlide(item); 
})

/*==================================
AVANZAR CON FLECHAS
==================================*/
function avanzar(){
	// Siempre que de un clic, el item tome un numero
	if(item==$("#slide ul li").length-1){ //Si es igual a la longitud de los li generados
		item=0;
	}else{
		item++; //Sino incrementa +1
	}
	//Envío la variable item
	movimientoSlide(item); 	
}


$("#slide #avanzar").click(function (){	
	avanzar();
})

/*==================================
RETROCEDER CON FLECHAS
==================================*/
$("#slide #retroceder").click(function (){	
	// Siempre que de un clic, el item tome un numero
	if(item==0){ //Si es igual a 3 (4) se reincia en o
		item=$("#slide ul li").length-1;//Cantidad de item que tenga el li
	}else{
		item--; //Sino incrementa +1
	}

	interrumpirCiclo=true;
	//Envío la variable item
	movimientoSlide(item); 
})


/*==================================
MOVIMIENTO SLIDE
==================================*/

function movimientoSlide(item){
	$("#slide ul li").finish();//Detiene animaciones
	//ul modifica el css la propiedad left 	
	$("#slide ul").animate({"left":item * -100+"%"}, 1000, "easeOutQuart"); //Multiplica el item * -100% en cada segundo , esto de slide.css line 15
	$("#paginacion li").css({"opacity":.5});//Cada li tenga una opacidd de .5
	// console.log("itemPaginacion",itemPaginacion);
	$(itemPaginacion[item]).css({"opacity":1}); //Ilumina el itemPaginacion con el índice seeccionado
	interrumpirCiclo=true;//Dar clic pasa de false a true
	// Animacion img
	$(imgProducto[item]).animate({"top":-10+"%","opacity":0}, 100);
	$(imgProducto[item]).animate({"top":30+"px","opacity":1}, 600);
	// Animacion h1,h2,h3
	$(titulo1[item]).animate({"top":-10+"%","opacity":0}, 100);
	$(titulo1[item]).animate({"top":30+"px","opacity":1}, 600);

	$(titulo2[item]).animate({"top":-10+"%","opacity":0}, 100);
	$(titulo2[item]).animate({"top":30+"px","opacity":1}, 600);

	$(titulo3[item]).animate({"top":-10+"%","opacity":0}, 100);
	$(titulo3[item]).animate({"top":30+"px","opacity":1}, 600);
	//Animacion btn
	$(btnVerProducto[item]).animate({"top":-10+"%","opacity":0}, 100);
	$(btnVerProducto[item]).animate({"top":30+"px","opacity":1}, 600);
}


/*==================================
MUEVE EL SLIDE CADA 3 SEGUNDOS
==================================*/

setInterval(function(){
	// Si el cillo es interrumpido
	if(interrumpirCiclo==true){
		// Regresa a false la variable
		interrumpirCiclo=false;
		detenerIntervalo=false;
		$("#slide ul li").finish();//Detiene animaciones
	}else{
		// Si el intervalo este en falso esque no tengo el cursos encima del slide
		if(detenerIntervalo==false){
			// Sino es interrumpido ps ejecuta la funcion avanzar
			avanzar();
		 } //y si es verdadero esque tengo e cursor en slide
	}
	
}, 3000)


/*==================================
APARECER/DESAPARECER FLECHAS
==================================*/
// opacity de 0 a 1 linea 158,167 slide.css
//Al pasar el mouse
$("#slide").mouseover(function (){
	$("#slide #retroceder").css({"opacity":1});
	$("#slide #avanzar").css({"opacity":1});
	detenerIntervalo=true;
})

//Al quitar el mouse
$("#slide").mouseout(function (){
	$("#slide #retroceder").css({"opacity":0});
	$("#slide #avanzar").css({"opacity":0});
	detenerIntervalo=false;
})


/*==================================
ESCONDER SLIDE
==================================*/
$("#btnSlide").click(function(){
	if(toggle==false){
		toggle=true;
		$("#slide").slideUp("fast");
		$("#btnSlide").html('<i class="fa fa-angle-down"></i>')
	}else{
		toggle=false;
		$("#slide").slideDown("fast");
		$("#btnSlide").html('<i class="fa fa-angle-up"></i>')
	}	
})