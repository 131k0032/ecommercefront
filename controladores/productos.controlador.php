<?php 

	class ControladorProductos{


		/*----------   MOSTRANDO CATEGORIAS  ----------*/
		static public function ctrMostrarCategorias($item, $valor){
			$tabla="categorias";
			$respuesta=ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);
			return $respuesta;
		}

		/*----------  MOSTRANDO SUBCATEGORIAS  ----------*/
		static public function ctrMostrarSubCategorias($item, $valor){
			$tabla="subcategorias";
			$respuesta=ModeloProductos::mdlMostrarSubCategorias($tabla, $item, $valor);
			return $respuesta;
		}

		/*----------  MOSTRANDO PRODUCTOS GRATIS  ----------*/
		static public function ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo){ //CUando ya tiene parametros se convierte en static
			$tabla="productos";
			$respuesta=ModeloProductos::mdlMostrarProductos($tabla, $ordenar, $item, $valor, $base, $tope, $modo);
			return $respuesta;
		}

		/*----------  MOSTRANDO INFO PRODUCTOS  ----------*/
		
		static public function ctrMostrarInfoProducto($item, $valor){
			$tabla="productos";
			$respuesta=ModeloProductos::mdlMostrarInfoProducto($tabla, $item, $valor);
			return $respuesta;
		}

		/*----------  LISTARPRODUCTOS PARA PAGINACION  ----------*/
		static public function ctrListarProductos($ordenar, $item, $valor){
			$tabla="productos";
			$respuesta=ModeloProductos::mdlListarProductos($tabla, $ordenar, $item, $valor);
			return $respuesta;
		}


		/*----------   MOSTRANDO BANNER  ----------*/
		static public function ctrMostrarBanner($ruta){
			$tabla="banner";
			$respuesta=ModeloProductos::mdlMostrarBanner($tabla, $ruta);
			return $respuesta;
		}

		/*----------  BUSCADOR  ----------*/
		static public function ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope){
			$tabla="productos";
			$respuesta=ModeloProductos::mdlBuscarProductos($tabla, $busqueda, $ordenar, $modo, $base, $tope);
			return $respuesta;

		}

		/*----------  LISTAR PRODUCTOS BUSCADOR  ----------*/
		static public function ctrListarProductosBusqueda($busqueda){
			$tabla ="productos";
			$respuesta=ModeloProductos::mdlListarProductosBusqueda($tabla, $busqueda);
			return $respuesta;

		}

		/*----------  ACTUALIZAR VISTA PRODUCTO CON AJAX, VIENE ENLAZADO CON PRODUCTO.AJAX.PHP E INFOPRODUCTO.JS  ----------*/
		static public  function ctrActualizarVistaProducto($datos, $item){
			$tabla ="productos";
			$respuesta = ModeloProductos::mdlActualizarVistaProducto($tabla, $datos, $item);
			return $respuesta;

		}


		
	}


?>