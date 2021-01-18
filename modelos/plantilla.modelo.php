<?php 

	require_once "conexion.php";


	class ModeloPlantilla{


		//Static cuando hay parámetros
		static public function mdlEstiloPlantilla($tabla){
			$stmt =Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetch();//Solo una linea fetch
			$stmt->close();
		}

	}


 ?>