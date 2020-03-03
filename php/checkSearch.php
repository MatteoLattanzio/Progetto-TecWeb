<?php
	function search(){
		if(isset($_POST["cerca"]))
			return $_POST["cerca"];
		else return '';
	}
?>