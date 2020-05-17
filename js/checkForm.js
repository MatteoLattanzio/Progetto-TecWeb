
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
    else document.getElementById("errore-nome").innerHTML ="";
  	if (cognome==""){
    document.getElementById("errore-cognome").innerHTML ="<p>Inserire cognome</p>";
  		x=false;
  	}
    else document.getElementById("errore-cognome").innerHTML ="";
  	if (data==""){
    document.getElementById("errore-data").innerHTML ="<p>Inserire data</p>";
  		x=false;
  	}
    else document.getElementById("errore-data").innerHTML ="";
  	if (indirizzo==""){
    document.getElementById("errore-indirizzo").innerHTML ="<p>Inserire indirizzo</p>";
  		x=false;  	
  	}
    else document.getElementById("errore-indirizzo").innerHTML ="";
  	if (!email_valid.test(email) || email == ""){
    document.getElementById("errore-email").innerHTML ="<p>Inserire email valida</p>";
  		x=false;
  	}
    else document.getElementById("errore-email").innerHTML ="";
  	if (usernameR==""){
    document.getElementById("errore-usernameR").innerHTML ="<p>Inserire username</p>";
  		x=false;
  	}
    else document.getElementById("errore-usernameR").innerHTML ="";
  	if ((passwordR.length<6) || (passwordR == "")) {
    document.getElementById("errore-passwordR").innerHTML ="<p>Inserire una password di almeno 6 caratteri</p>";
  		x=false;
  	}
    else document.getElementById("errore-passwordR").innerHTML ="";
  	if (passwordR2==""){
    document.getElementById("errore-password2R").innerHTML ="<p>Confermare password</p>";
  		x=false;
  	}
  	else if (passwordR2!=passwordR){
    document.getElementById("errore-password2R").innerHTML ="<p>Le password non coincidono</p>";
  		x=false;
  	}
    else document.getElementById("errore-password2R").innerHTML ="";
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
  else document.getElementById("errore-usernameL").innerHTML ="";
  if(passwordL==""){
    document.getElementById("errore-passwordL").innerHTML = "<p>Inserire password</p>";
    x=false;
  }
  else document.getElementById("errore-passwordL").innerHTML ="";
  return x;

}

function validaUpload(){
  var x;
  x=true;
  titolo = document.getElementById("titolo").value;
  prezzo = document.getElementById("prezzo").value;
  file = document.getElementById("File").files.length;
  sel = document.getElementById("Categoria");
  for(var i = 0,len = sel.options.length;i<len;i++) {
        opt = sel.options[i];
        if ( opt.selected === true && opt.disabled === true) {
            document.getElementById("errore-categoria").innerHTML = "<p>Scegli una categoria per la tua foto</p>";
        
    x=false;
        }else document.getElementById("errore-categoria").innerHTML ="";
    }
  if(titolo== "" ){
    document.getElementById("errore-titolo").innerHTML = "<p>Inserisci un titolo</p>";
    x=false;
  }
  else document.getElementById("errore-titolo").innerHTML ="";
  if(prezzo == "" ){
    document.getElementById("errore-prezzo").innerHTML = "<p>Inserisci il prezzo</p>";
    x=false;
  }
  else document.getElementById("errore-prezzo").innerHTML ="";
  if( file== 0 ){
    document.getElementById("errore-file").innerHTML = "<p>Scegli una foto da caricare</p>";
    x=false;
  }
  else document.getElementById("errore-file").innerHTML ="";
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
  else document.getElementById("errore-password").innerHTML ="";
  return x;
}