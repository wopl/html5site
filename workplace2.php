<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- workplace2.php                                (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Zeiterfassung - Auswahl Baustelle</h1>

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

	$myuserid		= $_POST['r_userid'];

    $query = $mysqli->query ("SELECT firstname, lastname 
							  FROM user WHERE id='$myuserid'");
    $result = $query->fetch_object();

	echo "<h3>Monteur: {$result->firstname} {$result->lastname} </h3>";
	echo "Hinweis: Baustellen werden hier nur angezeigt, wenn sie:";
	echo "<ul>";
	echo "<li>aktiv sind</li>";
	echo "<li>dem Monteur zugeordnet sind</li>";
	echo "<li>wenigstens einen Arbeitsschritt beinhalten (noch nicht implementiert)</li>";
	echo "</ul><br>\n";
	
//-----------------------------------------------------------------------------------
// show workplace-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, short, kunde, country, zip, town, street, number, locremark, contact, phone, active, flags
						  FROM workplace
						  WHERE active = '1'
						  AND id IN (SELECT workid FROM user2work WHERE userid = '$myuserid')");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> ID </th>
	<th> K&uumlrzel </th>
	<th> Kunde </th>
	<th> PLZ </th>
	<th> Stadt </th>
	<th> Stra&szlige </th>
	</tr>\n";
	
while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->short}" . "</td>"
		. "<td>" . "{$result->kunde}" . "</td>"
		. "<td>" . "{$result->country}" . "-" . "{$result->zip}" . "</td>"
		. "<td>" . "{$result->town}" . "</td>"
		. "<td>" . "{$result->street}" . " " . "{$result->number}" . "</td>"

		. "<form action='index.php?section=workplace3' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_userid' value=" . "'$myuserid'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_custid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='select' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
echo "</table><br /><br />";
?>

<form action="index.php?section=workplace" method="post">
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='back' type='submit' value='back' /></td>
        </tr>
    </table>
</form>


	
