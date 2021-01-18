<?php 
	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";
	

	class AjaxUsuarios{

		public $validarEmail;

		public function ajaxValidarEmail(){

			$datos = $this->validarEmail;
			$respuesta=ControladorUsuarios::ctrMostrarUsuario("email",$datos);
			echo json_encode($respuesta);

		}

	}


	if(isset($_POST["validarEmail"])){
		$validarEmail = new AjaxUsuarios();
		$validarEmail->validarEmail=$_POST["validarEmail"];
		$validarEmail->ajaxValidarEmail();
	}

 ?>