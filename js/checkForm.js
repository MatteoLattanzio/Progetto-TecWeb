
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
    	text = text + "<p>Inserire nome</p>";
    	x=false;    	
  	}
  	if (cognome==""){
  		text = text + "<p>Inserire cognome</p>";
  		x=false;
  	}
  	if (data==""){
  		text = text + "<p>Inserire data di nascita</p>";
  		x=false;
  	}
  	if (indirizzo==""){
  		text = text + "<p>Inserire indirizzo</p>";
  		x=false;  	
  	}
  	if (!email_valid.test(email) || email == ""){
  		text = text + "<p> Inserire un indirizzo email valido</p>";
  		x=false;
  	}
  	if (usernameR==""){
  		text = text + "<p> Inserire username</p>";
  		x=false;
  	}
  	if ((passwordR.length<6) || (passwordR == "")) {
  		text = text + "<p> Inserire una password di almeno 6 caratteri</p>";
  		x=false;
  	}
  	if (passwordR2==""){
  		text = text + "<p>Confermare la password</p>";
  		x=false;
  	}
  	if (passwordR2!=passwordR){
  		text = text + "<p>Le password non coincidono</p>";
  		x=false;
  	}
    document.getElementById("errore").innerHTML = text;
    return x;
 }
