/*=================================
=            PLANTILLA            =
=================================*/
var rutaOculta=$("#rutaOculta").val();//Toma el value del id del input hidden de plantilla.php

// Herramienta tooltip
$('[data-toggle="tooltip"]').tooltip();


$.ajax({

	url:rutaOculta+"ajax/plantilla.ajax.php",
	success:function(respuesta){
	// ver en console todo lo de bd
		// console.log(respuesta);
	//Formateando en formato json
		// console.log(JSON.parse(respuesta).colorFondo);
	// Variables en la bd		
		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;
	// Ver en console
		// console.log("colorFondo", colorFondo);

	// Clase backColor y aplicar el estilo que el background sera igual a var colorFondo y el color será lo que haya en var colorTexto
	$(".backColor, .backColor a").css({"background":colorFondo, "color":colorTexto})
	// Clase barraSuperior y aplicar el estilo que el background sera igual a var barraSuperior y el color será lo que haya en var textoSuperior
	$(".barraSuperior, barraSuperior a").css({"background":barraSuperior, "color":textoSuperior})


	}
})

/*=================================
INTERCCION PLANTILA 
=================================*/

var btnList = $(".btnList");
//console.log("btnList",btnList.length); //ver cuantas cajas trae btnList (gratis, mas vendidos y mas vistos)

// btnList tiene una longitud de 3
for(var i =0; i<btnList.length; i++){
	// Muestra en grillas
	$("#btnGrid"+i).click(function(){//btnGid+la posicion en que se encuentre, 0,1,2
		// i pierde su valor de una funcion
		var numero=$(this).attr("id").substr(-1);//A esto que le doy clic (btnGrid) Obtenemos el atributo id btnGrid
		$(".list"+numero).hide();//concatenamos
		$(".grid"+numero).show();

		// Cambiando el color de btn clickeado
		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).removeClass("backColor");

	})

	// Muesra en lista
	$("#btnList"+i).click(function(){
		// i pierde su valor de una funcion
		var numero=$(this).attr("id").substr(-1);//Obtenemos el atributo id btnGrid
		$(".list"+numero).show();
		$(".grid"+numero).hide();
		// Cambiando el color de btn clickeado
		$("#btnGrid"+numero).removeClass("backColor");//.backColor viene de Linea 22
		$("#btnList"+numero).addClass("backColor");

	})
}


/*=================================
EFECTOS SCROLL
=================================*/
$(window).scroll(function(){

	var scrollY=window.pageYOffset;//Var para scrol en y

	if(window.matchMedia("(min-width:768px)").matches){ //Minimo para aplicar en mantallas 768
	// console.log("scrollY",scrollY);//Mostrando posicion y de scroll

	  if($(".banner").html()!=null){//Si no hay banner
	  		if(scrollY<($(".banner").offset().top)-100){//Si la posicion de scroll es menor a limite superior de banner
				// console.log("es menor");		
				$(".banner img").css({"margin-top":-scrollY/3+"px"});//Entra al banner>img modifica el margin top de acuerdo a la medida del scroll
			}else{
				scrollY=0;
			}
		  }

	}
	
})
// Vinculado en plantilla.js, llamado en plantilla.css pa qe funcione
$.scrollUp({
	scrollText:"",
	scrollSpeed:2000,
	easingText:"easeOutQuint"
})

/*=================================
MIGAS DE PAN
=================================*/
var pagActiva = $(".pagActiva").html();

if(pagActiva != null){ //si pagina activa viene con informacion como cursos-web
	var regPagActiva = pagActiva.replace(/-/g, " ");//Todo lo que contenga guiones, sea reemplazado por un espacio en blaco
    $(".pagActiva").html(regPagActiva); 

}

/*=================================
ENLACES PAGINACION
=================================*/
// para marcar como activa los numeros de paginas seleccionados
var url = window.location.href; //ver donde o que pagina me encuentro
var indice = url.split("/"); //Esto es lo mismo que explode
// console.log("indice", indice);
var pagActual = indice[5];

if(isNaN(pagActual)){
	$("#item1").addClass("active");
}else{
	//$("#item"+indice.pop()).addClass("active");//Agrega la clase active al ultimo indice, en este caso de la url
	$("#item"+pagActual).addClass("active");//Si pagActual está definido que se active item + pag actgual de paginacion

}
