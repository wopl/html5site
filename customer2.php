<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- customer2.php                                 (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Zuordnung Arbeitsschritte / Mitarbeiter </h1>
<h2> asdf </h2>

<?php
include "mysql/credentials.inc";

$mysqli = new mysqli($host,$username,$password,$database);

// Verbindung prüfen
if (mysqli_connect_errno()) {
	printf ("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
	exit();
}


//-----------------------------------------------------------------------------------
// react on previously pushed button to update mySQL database                                                     ---
//-----------------------------------------------------------------------------------

//	$mycustid		= $_POST['custid'];	
//	$myshort		= $_POST['short'];	
//	$mycustomer 	= $_POST['customer'];	
//	$mycountry		= $_POST['country'];	
//	$myzip			= $_POST['zip'];	
//	$mytown			= $_POST['town'];	
//	$mystreet		= $_POST['street'];	
//	$mynumber		= $_POST['number'];	
//	$mylocremark	= $_POST['locremark'];	
//	$mycontact		= $_POST['contact'];	
//	$myphone		= $_POST['phone'];	
//	$myactive		= $_POST['active'];	
//	if (isset($_POST['active'])) {
//		$myactive = '1';
//	} else {
//		$myactive = '0';
//	}
//	$myflags		= $_POST['flags'];	
	
//-----------------------------------------------------------------------------------
// show customer data
//-----------------------------------------------------------------------------------

//echo "<h2>" . "$mycustid" . " " . "$myshort" . "</h2><br />";
echo "hugo<br />";

//$result->close();
$mysqli -> close();
?>

