<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- sites.php                                     (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<?php

	switch ($section)
	{
		case "workplace":
			include ("workplace.php");
			break;
		case "travel":
			include ("travel.php");
			break;
//		case "about":
//			include ("about.php");
//			break;
//		case "contact":
//			include ("contact.php");
//			break;
//		case "database":
//			include ("database.php");
//			break;
		case "user":
			include ("user.php");
			break;
		case "customer":
			include ("customer.php");
			break;
		case "reports":
			include ("reports.php");
			break;
		case "logout":
			include ("logout.php");
			break;
		default:
			include ("home.php");
	}
?>