function addCode(key){
  var code = document.getElementById("cedulaKeypad");

  if(code.value.length < 9){
    code.value = code.value + key;
  }
}

function delCode(){
  	num = cedulaKeypad.value.length; if(cedulaKeypad.value != ""){
		cedulaKeypad.value = cedulaKeypad.value.substring(0,num-1);
	}
}

function emptyCode(){
  document.getElementById("cedulaKeypad").value = "";
}
