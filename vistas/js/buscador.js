
/*----------  BUSCADOR  ----------*/
$("#buscador a").click(function(){//Si el viene vacio el buscador pero aun asi le dan clic en la lupa
	if($("#buscador input").val()== ""){//Si es vacio
			$("#buscador a").attr("href", "");//mandalo a nada
	}

})


// Cuadndo el valor del input cambie
$("#buscador input").change(function(){

	var busqueda = $("#buscador input").val();//valor de lo que venga en el input
	var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/; //Lo que está permitido

	// si no pasa el test
	if(!expresion.test(busqueda)){
		$("#buscador input").val("");//vaciar el value
	}else{
		var evaluarBusqueda = busqueda.replace(/[áéíóúÁÉÍÓÚ ]/g,"_");//todo los espacios que escriba la persona sea remplazada por un guion y además acentos serán eliminados, tambien se agregaron al htacces
		var rutaBuscador = $("#buscador a").attr("href");//Toma el valos del href

		//Si es diferente de vacio
		if($("#buscador input").val()!=""){
			$("#buscador a").attr("href", rutaBuscador+"/"+evaluarBusqueda);//Concatena el valor input+lo que venga del buscador
		}	

	}

})


/*----------  BUSCADOR CON ENTER  ----------*/

$("#buscador input").focus(function(){
	// cuando se oprima la tecla enter
	$(document).keyup(function(event){

		event.preventDefault();
		if(event.keyCode==13 && $("#buscador input").val()!="" ){
			var rutaBuscador = $("#buscador a").attr("href");//Toma el valos del href
			window.location.href = rutaBuscador; //mandalo a al url del href
		}

	})

})