<?php 
	
	 class ControladorSlide{

	 	public function ctrMostrarSlide(){
	 		$tabla="slide";
	 		$respuesta = ModeloSlide::mdlMostrarSlide($tabla);
	 		//Retorna para que llegue a la vista
	 		return $respuesta;
	 	}
	 }

 ?>