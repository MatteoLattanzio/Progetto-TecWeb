<?php

class Header
{
	public static function build()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		$output = file_get_contents("html/header.html");
		return $output;
	}

}
