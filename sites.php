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
		default:
			include ("home.php");
	}
?>