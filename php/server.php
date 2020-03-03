<?php
$errors= array();

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'photo');
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	 
	//login
	

?>