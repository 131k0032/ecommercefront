/*=================================
=            CARROUSEL            =
=================================*/

$(".flexslider").flexslider({
	    animation: "slide",
	    controlNav: true,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 100,
	    itemMargin: 5

});

// Al darle clic a las imagenes que se encuentren dentro del .flexslider
$(".flexslider ul li img").click(function(){
	var capturaIndice = $(this).attr("value");
	 console.log(capturaIndice);
	$(".infoproducto figure.visor img").hide();//todo se esconda al darle clic
	$("#lupa"+capturaIndice).show(); //Muestra el id correspondiente de imagen clickeada
})

/*=================================
=            EFECTO LUPA            =
=================================*/

// Muestra imagen con cursor
$(".infoproducto figure.visor img").mouseover(function(event){//Cuando paso el cursor sobre la img
	var capturaImg = $(this).attr("src"); //Captura la imagen y su atributo
	$(".lupa img").attr("src", capturaImg);
	$(".lupa").fadeIn("fast");//Muestra la imagen oculta
	//Cambiando estilos
	$(".lupa").css({
		"height" :$(".visorImg").height()+"px",//La misma altura de visorImg
		"background":"#eee",
		"width":"100%"
	})

});

// oculta imagen con cursor
$(".infoproducto figure.visor img").mouseout(function(event){
	$(".lupa").fadeOut("fast");//Oculta la imagen
});

//Para ver la posicion del cursor en la imagen y mostrar más imagen
$(".infoproducto figure.visor img").mousemove(function(event){
	var posX = event.offsetX;
	var posY = event.offsetY;
	$(".lupa img").css({
		"margin-left" :-posX+"px" ,
		"margin-top" :-posY+"px"
	})

});

/*=================================
CONTADOR DE VISTAS
=================================*/
var contador=0;

// Cuando la ventana se cargue
$(window).on("load", function(){
	var vistas= $("span.vistas").html();//Capturamos el html de la etiqueta span
	var precio= $("span.vistas").attr("tipo");//Captura el tipo de producto de la etiqueta span
	// console.log("vistas", vistas);
	// console.log("precio", precio);
	contador =Number(vistas) + 1;
	
	$("span.vistas").html(contador);//A la maquetacion se le agrega el numero mas contador
	 // console.log("contador", contador);//

/*----------  VALIDAMOS EL PRECIO PARA VER SI ACTUALIZAR CAMPO VISTASGRATIS O VISTAS  ----------*/

	// Si el precio es igual a cero
	if(precio==0){
		var item ="vistasGratis";
	}else{
		var item ="vistas";
	}
/*----------  VERIFICAMOS LA RUTA PARA VER EL ID A ACTUALIZAR  ----------*/
	var urlActual=location.pathname; //Ruta completa
	
	// console.log("ruta",urlActual);
	var ruta=urlActual.split("/");//Separamos los /
	// console.log("ruta", ruta.pop());
	// console.log("Contador-", contador);
	// console.log("Campo valor-", item);
	// console.log("ruta-", ruta.pop());


/*----------  ENVIANDO DATOS CON AJAX  ----------*/

	var datos = new FormData();

	datos.append("valor", contador);
	datos.append("item", item);
	datos.append("ruta", ruta.pop());

	// Enviando los datos por medio de ajax
	// console.log(rutaOculta); 
	$.ajax({

	   url:rutaOculta+"ajax/producto.ajax.php",//Ruta donde mandar ese dato
	   method:"POST",//Metodo
	   data: datos,//datos a enviar
	   cache: false,
	   contentType: false,
	   processData: false,
	   success: function (respuesta){
	   		// console.log("respuesta", respuesta);
	   }

	});

});


