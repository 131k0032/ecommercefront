<?php 

	require_once "conexion.php";

	class ModeloProductos{

		/*----------  MOSTRANDO CATEGORIAS  ----------*/		
		static public function mdlMostrarCategorias($tabla, $item, $valor){

			//Si item es diferente de null ejcutalo en plantilla.php y trae la cateoria solicitada
			if($item !=null){
				$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();	
			// Si no es null trae todas las categorias	
			}else{				
				$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll();			
			}
			$stmt->close();
			$stmt=null;

		}

		/*----------  MOSTRANDO SUBCATEGORIAS  ----------*/
		static public function mdlMostrarSubCategorias($tabla, $item, $valor){
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);//Esto será igual al id de la categoria que se recibe
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;
		}		


		/*----------  MOSTRANDO PRODUCTOS  ----------*/
		static public function mdlMostrarProductos ($tabla, $ordenar, $item, $valor, $base, $tope, $modo){

			if($item !=null){ //Seleccionando un item con valor o una columna en especifico
				$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item ORDER BY $ordenar $modo LIMIT $base, $tope");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);//Esto será igual al id de la categoria que se recibe
				$stmt->execute();
				return $stmt->fetchAll();
			}else{
				$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $ordenar $modo LIMIT $base, $tope");
				$stmt->execute();
				return $stmt->fetchAll();
			}	
			$stmt->close();
			$stmt=null;

		}


		/*----------  MOSTRANDO INFO PRODUCTO  ----------*/
		static public function mdlMostrarInfoProducto($tabla, $item, $valor){
			//item="ruta", $valor= valor get de nuestra url amigable
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);//Esto será igual al id de la categoria que se recibe
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt=null;
		}		



		/*----------  LISTARPRODUCTOS PARA PAGINACION  ----------*/
		static public function mdlListarProductos($tabla, $ordenar, $item, $valor){
			if($item !=null){ //Seleccionando un item con valor o una columna en especifico
				$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item ORDER BY $ordenar DESC");
			 	$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);//Esto será igual al id de la categoria que se recibe
			 	$stmt->execute();
			 	return $stmt->fetchAll();
			}else{
			 	$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $ordenar DESC");
			 	$stmt->execute();
			 	return $stmt->fetchAll();
			}
			$stmt->close();
			$stmt=null;
		
		}


		/*----------  MOSTRANDO BANNER  ----------*/
		static public function mdlMostrarBanner($tabla, $ruta){
			//item="ruta", $valor= valor get de nuestra url amigable
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta=:ruta");
			$stmt->bindParam(":ruta",$ruta, PDO::PARAM_STR);//Esto será igual al id de la categoria que se recibe
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt=null;
		}	

		/*----------  BUSCADOR  ----------*/
		static public function mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope){
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta like '%$busqueda%' OR titulo  like '%$busqueda%' OR titular like '%$busqueda%' OR  descripcion like '%$busqueda%' ORDER BY $ordenar $modo LIMIT $base, $tope");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;

		}

		/*----------  LISTAR PRODUCTOS BUSQUEDA  ----------*/
		static public function mdlListarProductosBusqueda($tabla, $busqueda){
			$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta like '%$busqueda%' OR titulo  like '%$busqueda%' OR titular like '%$busqueda%' OR  descripcion like '%busqueda%'");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;
		}


		/*----------  ACTUALIZAR VISTA PRODUCTO CON AJAX, VIENE ENLAZADO CON PRODUCTOS.CONTROLADOR.PHP, PRODUCTO.AJAX.PHP E INFOPRODUCTO.JS  ----------*/
		static public function mdlActualizarVistaProducto($tabla, $datos, $item){
			$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE ruta = :ruta");
			$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
			$stmt->bindParam(":".$item, $datos["valor"], PDO::PARAM_STR);

				if($stmt->execute()){
						return "Ok";
					}else{
						return "Error";
				}

			$stmt->close();
			$stmt=null;
		}


	}
 ?>