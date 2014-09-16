<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- sites.php                                     (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<?php

	switch ($section)
	{
		case "about":
			include ("about.php");
			break;
		case "contact":
			include ("contact.php");
			break;
		case "database":
			include ("database.php");
			break;
		case "user":
			include ("user.php");
			break;
		case "customer":
			include ("customer.php");
			break;
		default:
			include ("home.php");
	}
?>