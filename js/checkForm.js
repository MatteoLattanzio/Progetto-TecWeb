
function validaRegistrazione() {
  var x, text, email_valid;
  x=true;
  text=" ";
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
