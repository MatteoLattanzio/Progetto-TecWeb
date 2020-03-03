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
			<div>
				<form action="login.php" method="post" name="login">
					<div class="input">
						<label for="username">Username</label>
						<input type="text" name="username" placeholder="Inserisci username">
						<p><?php getUsernameError($errors); ?></p>
					</div>
					<div class="input password">
						<label for="Password" class="label password"> Password</label>
						<input type="password" name="password" placeholder="********">
						<p><?php getPasswordError($errors); ?></p>
					</div>
					<button type="submit" name="Login">Login</button>
				</form>
			</div>
		</div>
		<div>
			<h1>Registrati <a href='registrazione.php'>qui</a></h1>
		</div>
	</body>
</html>

