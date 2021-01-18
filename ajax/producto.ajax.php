<?php 
	
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";
	
	class AjaxProductos {

		// Vienen de infoproducto.js
		public $valor; //Valor del contador
		public $item; //Si es campo vistasGratis o vistas
		public $ruta; //Url a modificar

		public function ajaxVistaProducto(){

			$datos = array("valor"=>$this->valor, "ruta"=>$this->ruta);
			
			$item=$this->item;
			//Obtiene la consulta desde el Controlador productos misma
			$respuesta = ControladorProductos::ctrActualizarVistaProducto($datos, $item);
			// var_dump($respuesta);
			echo $respuesta;
		
		}
	} 


	// Si viene por post variable valor de infoproducto.js
	if(isset($_POST["valor"])){
		// Objetos instanciando la clase AjaxProductos
		$vista = new AjaxProductos();
		$vista -> valor= $_POST["valor"];
		$vista -> item= $_POST["item"];
		$vista -> ruta= $_POST["ruta"];
		$vista -> ajaxVistaProducto();
	}


 ?>