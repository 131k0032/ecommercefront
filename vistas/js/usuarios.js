/*===================================================
=            VALIDAR REGISTRO DE USUARIO            =
===================================================*/

function registroUsuario(){
	/*----------  valdando nombre  ----------*/
	var nombre =$("#regUsuario").val();

	if(nombre != ""){
		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

			//Si no cumple la expresion
			if(!expresion.test(nombre)){
				$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Caracteres especiales, NO</div>')
			    return false;
			}

		}else{
			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Ponga su nombre pues</div>')
			return false;
		}




	/*----------  Validando email  ----------*/
	var email =$("#regEmail").val();

	if(email != ""){
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
			//Si no cumple la expresion
			if(!expresion.test(email)){
				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Escriba bien el correo</div>')
			    return false;
			}

		}else{
			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Ponga su email pues</div>')
			return false;
		}




	/*----------  Validando contrasela  ----------*/

	var password =$("#regPassword").val();

	if(password != ""){
		var expresion = /^[a-zA-Z0-9]*$/;
			//Si no cumple la expresion
			if(!expresion.test(password)){
				$("#regPassword").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Caracteres especiales, NO</div>')
			    return false;
			}

		}else{ 
			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Ponga su correo pues</div>')
			return false;
		}




	/*----------  Validando politicas  ----------*/
	var politicas = $("#regPoliticas:checked").val();
		// si checkbox #regPoliticas es diferente a checked
		if (politicas!="on") {
			// Coloca encima del checkbox un alert
			$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Debe aceptar nuestras politicas</div>')
			return false;
		}


	return true
}