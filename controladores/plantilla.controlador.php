<?php

Class ControladorPlantilla{


/*----------  LLAMADO A LA PLANTILLA  ----------*/
	public function plantilla (){

		include "vistas/plantilla.php";
	}


/*----------  TRAEMOS ESTILOS DINAMICOS A LA PLANTILLA  ----------*/
	public function ctrEstiloPlantilla(){
		$tabla="plantilla";
		$respuesta=ModeloPlantilla::mdlEstiloPlantilla($tabla);
		return $respuesta;
	}

	
}


 ?>