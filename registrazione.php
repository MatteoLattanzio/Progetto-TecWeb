<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">



	<head>
		<?php 
	        include_once 'php/server.php'; 
	    ?>      
	</head>
	<body>
		<div>
			<form method="post" action="registrazione.php" >						
				<div >
					<label for="nome">Nome</label>
					<input type="text" name="nome" placeholder="Inserisci nome">
					<p><?php getNomeError($errors); ?></p>
				</div>
				<div >
					<label for="cognome">Cognome</label>
					<input type="text" name="cognome" placeholder="Inserisci cognome">
					<p><?php getCognomeError($errors); ?></p>
				</div>
				<div >
					<label for="data">Data</label>
					<input type="text" name="data" placeholder="Inserisci data">
					<p><?php getDataError($errors); ?></p>
				</div>
				<div >
					<label for="indirizzo">Indirizzo</label>
					<input type="text" name="indirizzo" placeholder="Inserisci indirizzo">
					<p><?php getIndirizzoError($errors); ?></p>
				</div>
				<div >
					<label for="email">E-Mail</label>
					<input type="email" name="email" placeholder="Inserisci E-mail">
					<p><?php getEmailError($errors); ?></p>
				</div>
				<div>
					<label for="username">Username</label>

					<input type="text" name="username" placeholder="Inserisci Username">			
					<p><?php getUsernameError($errors); ?></p>
				</div>
				<div>
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Inserisci password">
					<p><?php getPasswordError($errors); ?></p>	
				</div>
				<div >
					<label for="passwordR">Ripeti Password</label>
					<input type="password" name="passwordR" placeholder="Ripeti password">
					<p><?php getPasswordError($errors); ?></p>	
				</div>
				<button type="submit" name="registrazione">Registrati</button>
			</form>
		</div>
	</body>
</html>
