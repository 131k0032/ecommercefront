<?php 
	
	require_once "../controladores/plantilla.controlador.php";
	require_once "../modelos/plantilla.modelo.php";
	
	class AjaxPlantilla {

		public function ajaxEstiloPlantilla(){
			//Obtiene la consulta desde el Controlador plantilla misma que enlaza al modelo plantilla
			$respuesta = ControladorPlantilla::ctrEstiloPlantilla();
			// var_dump($respuesta);
			// Convierto el array en string
			echo json_encode($respuesta);
			// json_decode de string a array
		}
	}


	// Objetos instanciando la clase AjaxPlantilla
	$objeto = new AjaxPlantilla();
	$objeto->ajaxEstiloPlantilla();


 ?>