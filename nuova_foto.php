<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">



	<head>
		<?php 
	        require_once 'php/server.php'; 
	       
	    ?>      
	</head>
	<body>
		<form method="post" action="nuova_foto.php" enctype="multipart/form-data" name="carica_img">						
			<div >
				<label for="titolo">Titolo</label>
				<input type="text" name="titolo" placeholder="Inserire titolo" >
				<p class="error"><?php getTitoloError($errors); ?></p>
			</div>
			<div >
				<label for="prezzo">Prezzo</label>
				<input type="text" name="prezzo" placeholder="Inserire prezzo" >
				<p class="error"><?php getPrezzoError($errors); ?></p>
			</div>

			<h1>inserire tag (facoltativi)</h1>
			<div >
				<label for="tag1">Tag 1</label>
				<input type="text" name="tag1" placeholder="Inserire primo tag" >
			</div>
			<div >
				<label for="tag2">Tag 2</label>
				<input type="text" name="tag2" placeholder="Inserire secondo tag" >
			</div>
			<div >
				<label for="tag3">Tag 3</label>
				<input type="text" name="tag3" placeholder="Inserire terzo tag" >
			</div>
			<div class="select-categoria" >
				<label for="Categoria">Categoria</label>
				<select  name="selectCategoria">
					<option name="c0" value="Seleziona">Seleziona categoria</option>
					<option name="c1" value="1">1</option>
					<option name="c2" value="c2">2</option>
					<option name="c3" value="c3">3</option>
					<option name="c4" value="c4">4</option>
					<option name="c5" value="c5">5</option>
					<option name="c6" value="c6">6</option>
					<option name="c7" value="c7">7</option>
					<option name="c8" value="c8">8</option>
				 
				</select>
				<p class="error"><?php getCategoriaError($errors); ?></p>
			</div>
			<input type="file" name="file"></input>
			<button type="submit" name="carica_img" >Invia</button>
		</form>
	</body>
</html>