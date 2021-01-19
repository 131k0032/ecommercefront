/*==============================================
=            CAPTURA DE RUTA ACTUAL            =
==============================================*/
var rutaActual = location.href;
$(".btnIngreso").click(function(){

	localStorage.setItem("rutaActual", rutaActual);

})

/*===================================================
=            FORMATEAR INPUTS                       =
===================================================*/
//Elimina los alerts de los inputs al hacer click en cualquiera de ellos
$("input").focus(function(){
	$(".alert").remove();
})
/*===================================================
=            VALIDAR EMAIL REPETIDO                 =
===================================================*/
var validarEmailRepetido = false;//Incia con un email que no está en el sistema con false
//Cuando el campo regEmail cambie
$("#regEmail").change(function(){

	// Tomamos el valor que Escriba  en el campo regEmail
	var email = $("#regEmail").val();
	var datos = new FormData();
	datos.append("validarEmail",email);

	$.ajax({
		url:rutaOculta+"ajax/usuarios.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
			console.log("respuesta",respuesta);
			if(respuesta=="false"){

				$(".alert").remove();
				validarEmailRepetido = false;//Mantiene en falso el email registrado o que no está en el sistema
				
				}else{

					var modo = JSON.parse(respuesta).modo;//Como se registró el user
					// console.log(modo);

					if (modo=="directo") {
						modo="ésta pagina";
					}

					$("#regEmail").parent().before('<div class="alert alert-warning"><strong>Uy </stron>Correo previamente registrado en '+modo+' pliz agrega otro </div>')
					validarEmailRepetido = true; //Si el email está repetido se convierte en true y no deja pasar
					console.log(validarEmailRepetido);


			}
		}
	})

})



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

			//Si validarEmailRepetido es falso
			if(validarEmailRepetido){

				$("#regEmail").parent().before('<div class="alert alert-danger"><strong>Uy </stron>Correo previamente registrado pliz agrega otro </div>')
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