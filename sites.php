<?php

	switch ($section)
	{
		case "about":
			include ("about.php");
			break;
		case "contact":
			include ("contact.php");
			break;
		default:
			include ("home.php");
	}
?>