//Fichero para las funciones JS
//Fecha: 28/10/2019
//Creado por: Iago Fernandez Martinez

//Funcion comprobarVacio(): Comprueba si el campo pasado está vacío y devuelve true en caso afirmativo
function comprobarVacio(campo) {;
  var input = campo.value; //input: valor del campo pasado

  //Si el valor es vacío o son espacios
  if (input == '' || input.length == 0 || /^\s+$/.test(input)) {
    alert('Ingrese datos');
    return false;
  } 
  return true;
}

//funcion validarTexto(): Comprueba si el campo pasado es de un tamaño menor al tamaño pasado. En caso afirmativo true
function validarTexto(campo, size) {
  var input = campo.value; //input: valor del campo pasado
  
    //Si el tamaño es menor o null
    if (input.length <= size) {
        return true;
    }else{ //Si no
      alert('El texto excede los caracteres máximos permitidos');
    	return false;
    }
}

//funcion validarExpr(): Comprueba si el campo pasado coincide con la expresion y tamaño. En caso afirmativo true
function validarExpr(campo, expr, size) {
  var input = campo.value; //input: valor del campo pasado

  //Si el input cumple la expresion
  if(input.match(expr))
	{
      //si la longitud es menor 
	    if (input.length < size) {
          alert('El texto excede los caracteres máximos permitidos');	        
          return false;
	    }
	}else//si no
  {
    alert('La expresion no es correcta');
    return false;
  }

	return true;
}

//funcion validarAlfabetico(): Comprueba si el campo pasado es de tipo alfabetico y si esta dentro del tamaño establecido. En caso afirmativo true
function validarAlfabetico(campo, size){
  const pattern = new RegExp('^[A-Z]+$', 'i'); //Patron que define las letras del abecedario
  var input = campo.value; //input: valor del campo pasado

    // Segunda validacion, si input es mayor que size
    if(input.value.length > size) {
      return false;
    } 
    else 
    {
      // Tercera validacion, si input contiene caracteres diferentes a los permitidos
      if(!pattern.test(input.value)){ 
        return false;
      } else {
        // Si pasamos todas la validaciones anteriores, entonces el input es valido
        return true;
      }
    }
}


//funcion validarEntero(): Comprueba si el campo pasado es de tipo entero y que se encuentre entre los valores pasados. En caso afirmativo true
function validarEntero(campo, valorMax, valorMin){
  var input = campo.value; //input: valor del campo pasado

  //Comprueba si es entero, en caso de que no lo sea da Error de formato
    if (!/^([0-9])*$/.test(campo.value)) {
      alert('Error de formato');
    return false;
  } else {
    if (campo.value > valorMax) {//Comprueba que esté entre el valor maximo y minimo, si no, devuelve error
        alert('Error de formato');
        return false;
    } else {
      if (campo.value < valorMin) {
        alert('Error de formato');
        return false;
      }
    }
}
  return true;
}


//funcion validarReal(): Comprueba si el campo pasado es de tipo real y que se encuentre entre los valores pasados. En caso afirmativo true
function validarReal(campo, numeroDecimal, valorMin, valorMax){
  var input = campo.value; //input: valor del campo pasado
	const real = new RegExp('^[0-9]*.[0-9]*$'); //Patron que define el formato de un numero real

  //si cumple la expresion
	if(real.test(campo)){
		campo.toFixed(numeroDecimal);
    //si esta entre los valores pasados
		if(campo > valorMin && campo < valorMax){
			return true;
		}
	}
	return false;
}

//funcion validarDNI(): Comprueba si el campo pasado es un dni. En caso afirmativo true
function validarDNI(campo) {
  var input = campo.value; //input: valor del campo pasado
  var numero //numero del dni pasado
  var letr //letra del dni pasado
  var letra //letras posibles
  var expresion_regular_dni //expresion regular de un dni
 
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
 
 //si cumple la expresion regular
  if(expresion_regular_dni.test (input) == true){
     numero = input.substr(0,input.length-1);
     letr = input.substr(input.length-1,1);
     numero = numero % 23;
     letra='TRWAGMYFPDXBNJZSQVHLCKET';
     letra=letra.substring(numero,numero+1);

     //si la letra posible es distinta a la letra real
    if (letra!=letr.toUpperCase()) {
      alert('DNI no valido');
       return false;
     }else{
       return true;
     }
  }else{//si no cumple expresion regular
    alert('DNI no valido');
     return false;
   }
}

//function validarTelefono: Valida el campo pasado para comprobar si coincide con el formato de telefono
function validarTelefono(campo){
  var input = campo.value; //input: valor del campo pasado
  var patt = new RegExp(/^(\+34|0034|34)?[6|7|8|9][0-9]{8}$/i); //expresion regular para comprobar un telefono

  //si cumple la expresion regular
  if (input.match(patt)){
      return true;
  } else { //si no
    alert('Telefono no válido');
    return false;
  }
}

//function validarEmail: Valida el campo pasado para comprobar si coincide con el formato de mail
function validarEmail(campo) {
    var input = campo.value; //input: valor del campo pasado
    var pattern = new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/, 'i'); //patron para mail
      
      if (!patron.test(input)){ // si no cumple el patron
        alert('Email no valido');
        return false;
      }   
      return true;  
    }

//function validarCentro: Valida todos los campos del form para añadir un centro
function validarCentro(centroForm){
  var form = document.forms[centroForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODCENTRO']) || !validarTexto(form.elements['CODCENTRO'], 10)){
    alert('Error en CODCENTRO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['NOMBRECENTRO']) || !validarTexto(form.elements['NOMBRECENTRO'], 50)){
    alert('Error en NOMBRECENTRO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['DIRECCIONCENTRO']) || !validarTexto(form.elements['DIRECCIONCENTRO'], 50)){
    toret = false;
    alert('Error en DIRECCIONCENTRO');
  }
  if(!comprobarVacio(form.elements['RESPONSABLECENTRO']) || !validarTexto(form.elements['RESPONSABLECENTRO'], 60)){
    toret = false;
    alert('Error en RESPONSABLECENTRO');
  }

  return toret;
}

//function validarEdificio: Valida todos los campos del form para añadir un edificio
function validarEdificio(edificioForm){
  var form = document.forms[edificioForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODEDIFICIO']) || !validarTexto(form.elements['CODEDIFICIO'], 10)){
    alert('Error en CODEDIFICIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['NOMBREEDIFICIO']) || !validarTexto(form.elements['NOMBREEDIFICIO'], 50)){
    alert('Error en NOMBREEDIFICIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['DIRECCIONEDIFICIO']) || !validarTexto(form.elements['DIRECCIONEDIFICIO'], 50)){
    toret = false;
    alert('Error en DIRECCIONEDIFICIO');
  }
  if(!comprobarVacio(form.elements['CAMPUSEDIFICIO']) || !validarTexto(form.elements['CAMPUSEDIFICIO'], 60)){
    toret = false;
    alert('Error en CAMPUSEDIFICIO');
  }

  return toret;
}


//function validarEspacio: Valida todos los campos del form para añadir un espacio
function validarEspacio(espacioForm){
  var form = document.forms[espacioForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODESPACIO']) || !validarTexto(form.elements['CODESPACIO'], 10)){
    alert('Error en CODESPACIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['CODEDIFICIO'])){
    alert('Error en CODEDIFICIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['CODCENTRO'])){
    toret = false;
    alert('Error en CODCENTRO');
  }
  if(!comprobarVacio(form.elements['TIPO'])){
    toret = false;
    alert('Error en TIPO');
  }
  if(!comprobarVacio(form.elements['SUPERFICIEESPACIO']) || !validarEntero(form.elements['SUPERFICIEESPACIO'], 9999,0)){
    alert('Error en SUPERFICIEESPACIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['NUMINVENTARIOESPACIO']) || !validarEntero(form.elements['NUMINVENTARIOESPACIO'], 99999999,0)){
    alert('Error en NUMINVENTARIOESPACIO');
    toret = false;
  }
  return toret;
}

//function validarProfEspacio: Valida todos los campos del form para añadir un profespacio
function validarProfEspacio(profespacioForm){
  var form = document.forms[profespacioForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODESPACIO'])){
    alert('Error en CODESPACIO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['DNI'])){
    alert('Error en DNI');
    toret = false;
  }
  return toret;
}

//function validarProfTitulacion: Valida todos los campos del form para añadir un proftitu
function validarProfTitulacion(proftituForm){
  var form = document.forms[proftituForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODTITULACION'])){
    alert('Error en CODTITULACION');
    toret = false;
  }
  if(!comprobarVacio(form.elements['DNI'])){
    alert('Error en DNI');
    toret = false;
  }
  if(!comprobarVacio(form.elements['ANHOACADEMICO']) || !validarTexto(form.elements['ANHOACADEMICO'], 9)){
    alert('Error en ANHOACADEMICO');
    toret = false;
  }
  return toret;
}

//function validarProfesor: Valida todos los campos del form para añadir un profesor
function validarProfesor(profForm){
  var form = document.forms[profForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['DNI']) || !validarDNI(form.elements['DNI'])){
    alert('Error en DNI');
    toret = false;
  }
  if(!comprobarVacio(form.elements['NOMBREPROFESOR']) || !validarAlfabetico(form.elements['NOMBREPROFESOR'], 15)){
    alert('Error en NOMBREPROFESOR');
    toret = false;
  }
  if(!comprobarVacio(form.elements['APELLIDOSPROFESOR']) || !validarAlfabetico(form.elements['APELLIDOSPROFESOR'], 30)){
    alert('Error en APELLIDOSPROFESOR');
    toret = false;
  }  
  if(!comprobarVacio(form.elements['AREAPROFESOR']) || !validarTexto(form.elements['AREAPROFESOR'], 60)){
    alert('Error en AREAPROFESOR');
    toret = false;
  }
  if(!comprobarVacio(form.elements['DEPARTAMENTOPROFESOR']) || !validarTexto(form.elements['DEPARTAMENTOPROFESOR'], 60)){
    alert('Error en DEPARTAMENTOPROFESOR');
    toret = false;
  }

  return toret;
}

//function validarTitulacion: Valida todos los campos del form para añadir un Titulacion
function validarTitulacion(TitulacionForm){
  var form = document.forms[TitulacionForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['CODTITULACION']) || !validarTexto(form.elements['CODTITULACION'], 10)){
    alert('Error en CODTITULACION');
    toret = false;
  }
  if(!comprobarVacio(form.elements['CODCENTRO'])){
    alert('Error en CODCENTRO');
    toret = false;
  }
  if(!comprobarVacio(form.elements['NOMBRETITULACION']) || !validarTexto(form.elements['NOMBRETITULACION'], 50)){
    alert('Error en NOMBRETITULACION');
    toret = false;
  }  
  if(!comprobarVacio(form.elements['RESPONSABLETITULACION']) || !validarTexto(form.elements['RESPONSABLETITULACION'], 60)){
    alert('Error en RESPONSABLETITULACION');
    toret = false;
  }

  return toret;
}

//function validarUsuario: Valida todos los campos del form para añadir un Usuario
function validarUsuario(UsuarioForm){
  var form = document.forms[UsuarioForm]; //Contiene datos del formulario
  var toret = true; //Valor a devolver, true si form es correcto, false si no
  
  //Se validan los input, de manera que si uno falla devuelva false
  if(!comprobarVacio(form.elements['login']) || !validarTexto(form.elements['login'], 15)){
    alert('Error en login');
    toret = false;
  }
  if(!comprobarVacio(form.elements['password']) || !validarTexto(form.elements['password'], 20)){
    alert('Error en password'); 
    toret = false;
  }
  if(!comprobarVacio(form.elements['DNI']) || !validarDNI(form.elements['DNI'])){
    alert('Error en DNI');
    toret = false;
  }
  if(!comprobarVacio(form.elements['nombre']) || !validarAlfabetico(form.elements['nombre'], 30)){
    alert('Error en nombre');
    toret = false;
  }
  if(!comprobarVacio(form.elements['apellidos']) || !validarAlfabetico(form.elements['apellidos'], 50)){
    alert('Error en apellidos');
    toret = false;
  }
  if(!comprobarVacio(form.elements['email']) || !validarTexto(form.elements['email'], 60) || !validarEmail(form.elements['email'])){
    alert('Error en email'); 
    toret = false;
  }
  if(!comprobarVacio(form.elements['telefono']) || !validarTelefono(form.elements['telefono'])){
    alert('Error en telefono'); 
    toret = false;
  }
  if(!comprobarVacio(form.elements['fotopersonal']) || !validarTexto(form.elements['fotopersonal'], 50)){
    alert('Error en password'); 
    toret = false;
  }
  if(!comprobarVacio(form.elements['FechaNacimiento'])){
    alert('Error en FechaNacimiento'); 
    toret = false;
  }
  if(!comprobarVacio(form.elements['sexo'])){
    alert('Error en sexo'); 
    toret = false;
  }
  
  return toret;
}