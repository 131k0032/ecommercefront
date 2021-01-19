<?php 
	
	class ControladorUsuarios{


		/*----------   NUEVO USUARIO  ----------*/
		public function ctrRegistroUsuario (){

			if(isset($_POST["regUsuario"])){

				if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
				   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9]{2,4}$/', $_POST["regEmail"]) && 
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

				   	$encriptar = crypt($_POST['regPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				    $encriptarEmail= md5($_POST["regEmail"]);

				   	$datos  = array("nombre" => $_POST["regUsuario"],              
							   		"password"=>$encriptar,
							   	    "email"=>$_POST["regEmail"],
							   	    "modo"=>"directo",
							   		"verificacion"=>1,
							   		"emailEncriptado"=>$encriptarEmail);//0 es igual a cuenta veerificada
				   $tabla="usuarios";
				   $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);
				   //var_dump($respuesta);

				   // verifica correo electronico
				   date_default_timezone_set("America/Cancun");//Zona hooraria en al que se manda el correo
				   $url =Ruta::ctrRuta();

				   $mail = new PHPMailer;
				   $mail->CharSet = 'UTF-8';
				   $mail->isMail();
				   $mail->setFrom('masterchief22010@hotmail.com','La mera reata jeje'); //De donte
				   $mail->addReplyTo('masterchief22010@hotmail.com','La mera reata jeje');
				   $mail->Subject = "Por favor checa tu correo";
				   $mail->addAddress($_POST["regEmail"]);// a quien se envia
				   //Maquetado de correo a enviar
				   $mail->msgHTML('<div style="width: 100%; background:#eee; position: relative; font-family: sans-serif; padding-bottom:40px;">
										<center>
											<img style="padding:20px; width: 10px;" src="http://tutorialesatualcance.com/tienda/logo.png" alt="">
										</center>

										<div style="position: relative; margin:auto; width: 600px; background: white; padding: 20px;">
											<center>
												<img style="padding: 20px; width: 15%;" src="http://tutorialesatualcance.com/tienda/icon-email.png" alt="">
												<h3 style="font-weight: 100; color: #999">Verifica tu correo men</h3>
												<hr style="border: 1px solid #ccc; width: 80%;">
												<h4 style="font-weight: 100; color: #999; padding: 0 20px;">Para usar su cienta de tienda virtual debes confirmar tu cuenta pliz</h4>

												<a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration: none;">
													<div style="line-height: 60px; background: #0aa; width: 60%; color: white;" >Verifica tu correo electronico</div>
												</a>

												<br>

												<hr style="border: 1px solid #ccc; width: 80%;">
												<h5 style="font-weight: 100; color: #999;">Si no te inscribiste en este sitio omite el correo y se va eliminar jeje</h5>
											</center>
										</div>

									</div>');

				   $envio = $mail->Send();

				   if(!$envio){

				   		echo '<script>
							swal({
									title: "¡Error!",
									text: "Error de envio de correo electronico a '.$_POST["regEmail"].$mail->ErrorInfo.'",
									type: "error",
									confirmButtonText: "Cerrar",
									confirmOnClose: "false"
								},

								function(isConfirm){
									if(isConfirm){
										history.back();
									}
								});

					    </script>';


				   }else{

				   		 // Luego de mandar el correo en su caso manda la alerta de registro exitoso

					 	if($respuesta=="ok"){
					 			echo '<script>
									swal({
											title: "¡Genial!",
											text: "Registro exitoso, porfavor verifica tu correo '.$_POST["regEmail"].' para verificar tu cuenta",
											type: "success",
											confirmButtonText: "Cerrar",
											confirmOnClose: "false"
										},

										function(isConfirm){
											if(isConfirm){
												history.back();
											}
										});

							    </script>';

					 	}
				   }

				  
				}else{

					echo '<script>
							swal({
									title: "¡Error!",
									text: "Error de registro",
									type: "error",
									confirmButtonText: "Cerrar",
									confirmOnClose: "false"
								},

								function(isConfirm){
									if(isConfirm){
										history.back();
									}
								});

					    </script>';
				}

				
			}

		}



		/*----------   MOSTRAR USUARIO  ----------*/

		public function ctrMostrarUsuario($item, $valor){
			
			$tabla="usuarios";
			$respuesta =ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
			return $respuesta;
		}

		/*----------   ACTUALIZAR USUARIO  ----------*/
		public function ctrActualizarUsuario($id, $item, $valor){
			
			$tabla="usuarios";
			$respuesta =ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);
			return $respuesta;
		}

		/*----------   INGRESO DE USUARIO  ----------*/
		public function ctrIngresoUsuario(){

			if (isset($_POST["ingEmail"])) {
				if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9]{2,4}$/', $_POST["ingEmail"]) && 
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				   		$encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				   		$tabla="usuarios";
				   		$item="email";
				   		$valor=$_POST["ingEmail"];
				   		$respuesta=ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

				   			// Comparamos el correo obtenido y el pass encriptado
				   			if(isset($respuesta["email"])  && $respuesta["email"]==$_POST["ingEmail"]  && isset($respuesta["emailEncriptado"]) && $respuesta["password"]==$encriptar){
				   			
				   				//Si  no está verificado la cuenta
				   				if( isset($respuesta["verificacion"]) && $respuesta["verificacion"]==1){
				   					echo '<script>
											swal({
													title: "¡Error!",
													text: "Error de acceso, favor de verificar su correo",
													type: "error",
													confirmButtonText: "Cerrar",
													confirmOnClose: "false"
												},

												function(isConfirm){
													if(isConfirm){
														history.back();
													}
												});

									    </script>';
				   				}else{
				   					// Si está verificado la cuenta
				   					$_SESSION["validarSesion"]="ok";
				   					$_SESSION["id"]=$respuesta["id"];
				   					$_SESSION["nombre"]=$respuesta["nombre"];
				   					$_SESSION["foto"]=$respuesta["foto"];
				   					$_SESSION["email"]=$respuesta["email"];
				   					$_SESSION["password"]=$respuesta["password"];
				   					$_SESSION["modo"]=$respuesta["modo"];

				   					// Toma la ruta actual o mandalo a la ruta actual (variable en archivo usuarios.js)
				   					echo '<script>
											window.location =localStorage.getItem("rutaActual");
									    </script>';
				   				}

				   			}else{

				   					// Si no encuentran coincidencias en la bd
				   					echo '<script>
											swal({
													title: "¡Error!",
													text: "Usuario o contraseña incorrectos",
													type: "error",
													confirmButtonText: "Cerrar",
													confirmOnClose: "false"
												},

												function(isConfirm){
													if(isConfirm){
														window.location =localStorage.getItem("rutaActual");
													}
												});

									    </script>';
				   						
				   			}

				   	// Si no cumple con la expresion regular
					}else{
						echo '<script>
									swal({
											title: "¡Error!",
											text: "Errir de acceso, Caracteres especiales no permitidos",
											type: "error",
											confirmButtonText: "Cerrar",
											confirmOnClose: "false"
										},

										function(isConfirm){
											if(isConfirm){
												history.back();
											}
										});

							    </script>';

			}
		
		}


    }
	
 }


 ?>