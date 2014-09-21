<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- workplace3.php                                (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Zeiterfassung Baustelle</h1>

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

$myuserid	= $_POST['r_userid'];
$mycustid	= $_POST['r_custid'];

//-----------------------------------------------------------------------------------
// show user data
//-----------------------------------------------------------------------------------

$query = $mysqli->query ("SELECT firstname, lastname 
						  FROM user WHERE id='$myuserid'");
$result = $query->fetch_object();

echo "<h3>Monteur: {$result->firstname} {$result->lastname} </h3>";

//-----------------------------------------------------------------------------------
// show customer data
//-----------------------------------------------------------------------------------

$query = $mysqli->query ("SELECT short, kunde, country, zip, town, street, number, 
						locremark, contact, phone, active, flags FROM workplace WHERE id='$mycustid'");
$result = $query->fetch_object();


echo "<b>" .
	 "$mycustid" . 
	 " " .
	 "$result->short" .
	 "</b> " .
     "Aktiv: " .
	 "$result->active" .
	 " Flags: " .
	 "$result->flags" .
	 "<br />";
//echo "<font size='+1'>";
echo "<b>" .
	 "$result->kunde" .
	 "</b>, " .
	 "$result->street" .
	 " " .
	 "$result->number" .
	 ", " .
	 "$result->country" .
	 "-" .
	 "$result->zip" .
	 " " .
	 "$result->town" .
	 "<br />";
echo "$result->locremark" .
     "<br />";
echo "Ansprechpartner: " . 
	 "$result->contact" .
	 " " .
	 "$result->phone" .
	 "<br /><br />";
//echo "</font>";

//-----------------------------------------------------------------------------------
// show worksteps-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, short, budget, description FROM worksteps");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> ID </th>
	<th> K&uumlrzel </th>
	<th> Budget </th>
	<th> Beschreibung </th>
	</tr>\n";

while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->short}" . "</td>"
		. "<td>" . "{$result->budget}" . "h</td>"
		. "<td>" . "{$result->description}" . "</td>"
		. "<form action='index.php?section=worksteps' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_id' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_short' value=" . "'{$result->short}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_budget' value=" . "'{$result->budget}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_description' value=" . "'{$result->description}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
	
echo "</table><br />";
?>

<form action="index.php?section=workplace2" method="post">
	<br />
	<table>
    	<tr>
		<td><input type='hidden' id='uid1' name='r_userid' value='<?php echo "$myuserid" ?>'/></td>
 		<td><input class='css_btn_class' name='back' type='submit' value='back' /></td>
        </tr>
    </table>
</form>
