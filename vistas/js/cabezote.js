/*================================
=            CABEZOTE            =
================================*/
$("#btnCategorias").click(function (){

	// Si estás en dimensiones de dispositivo movil
	if(window.matchMedia("(max-width:767px)").matches){
		// Desliza debajo del cabezote el id categorias (este se encuentra como display none en cabezote.css)
		$("#btnCategorias").after($("#categorias").fadeToggle("fast"))		
		}else{
		// Si no ps muestralo debajo del id cabezote
		$("#cabezote").after($("#categorias").fadeToggle("fast"))
	}

})