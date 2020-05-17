
function validaRegistrazione() {
  var x, email_valid;
  x=true;
  email_valid = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
  nome = document.getElementById("nome").value;
  cognome = document.getElementById("cognome").value;
  data = document.getElementById("data").value;
  indirizzo = document.getElementById("indirizzo").value;
  email = document.getElementById("email").value;
  usernameR = document.getElementById("usernameR").value;
  passwordR = document.getElementById("passwordR").value;
  passwordR2 = document.getElementById("passwordR2").value;
  	if (nome=="") {
    document.getElementById("errore-nome").innerHTML ="<p>Inserire nome</p>";
    	x=false;    	
  	}
  	if (cognome==""){
    document.getElementById("errore-cognome").innerHTML ="<p>Inserire cognome</p>";
  		x=false;
  	}
  	if (data==""){
    document.getElementById("errore-data").innerHTML ="<p>Inserire data</p>";
  		x=false;
  	}
  	if (indirizzo==""){
    document.getElementById("errore-indirizzo").innerHTML ="<p>Inserire indirizzo</p>";
  		x=false;  	
  	}
  	if (!email_valid.test(email) || email == ""){
    document.getElementById("errore-email").innerHTML ="<p>Inserire email valida</p>";
  		x=false;
  	}
  	if (usernameR==""){
    document.getElementById("errore-usernameR").innerHTML ="<p>Inserire username</p>";
  		x=false;
  	}
  	if ((passwordR.length<6) || (passwordR == "")) {
    document.getElementById("errore-passwordR").innerHTML ="<p>Inserire una password di almeno 6 caratteri</p>";
  		x=false;
  	}
  	if (passwordR2==""){
    document.getElementById("errore-password2R").innerHTML ="<p>Confermare password</p>";
  		x=false;
  	}
  	else if (passwordR2!=passwordR){
    document.getElementById("errore-password2R").innerHTML ="<p>Le password non coincidono</p>";
  		x=false;
  	}
    return x;
 }

function validaLogin(){
  var x;
  x=true;
  usernameL = document.getElementById("Username").value;
  passwordL = document.getElementById("Password").value;
  if(usernameL==""){
    document.getElementById("errore-usernameL").innerHTML = "<p>Inserire username</p>";
    x=false;
  }
  if(passwordL==""){
    document.getElementById("errore-passwordL").innerHTML = "<p>Inserire password</p>";
    x=false;
  }
  return x;

}

function validaUpload(){
  var x;
  x=true;
  titolo = document.getElementById("titolo").value;
  prezzo = document.getElementById("prezzo").value;
  file = document.getElementById("File").files.length;
  if(titolo== "" ){
    document.getElementById("errore-titolo").innerHTML = "<p>Inserisci titolo</p>";
    x=false;
  }
  if(prezzo == "" ){
    document.getElementById("errore-prezzo").innerHTML = "<p>Inserisci prezzo</p>";
    x=false;
  }
  if( file== 0 ){
    document.getElementById("errore-file").innerHTML = "<p>Scegli un'immagine</p>";
    x=false;
  }
  return x;
}

function validaModifica(){
  var x;
  x=true;
  password = document.getElementById("password").value;
  if((password!="")&&(password.length<6)){
    document.getElementById("errore-password").innerHTML = "<p>Inserire una password di almeno 6 caratteri</p>";
    x=false;
  }
  return x;
}