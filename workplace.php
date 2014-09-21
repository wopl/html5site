<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- workplace.php                                 (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Zeiterfassung Baustelle - Login</h1>
Hinweis: Hier mu&szlig manuell die Auswahl des Monteurs vorgenommen werden.
In einer sp&aumlteren App auf dem Smartphone kann jeder Monteur nur seine eigenen Auftr&aumlge
bearbeiten.<br />
<br />

<?php
include "mysql/credentials.inc";

$mysqli = new mysqli($host,$username,$password,$database);

// Verbindung prüfen
if (mysqli_connect_errno()) {
	printf ("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
	exit();
}

//-----------------------------------------------------------------------------------
// show user-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, user, firstname, lastname, email, phone FROM user");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> ID </th>
	<th> User </th>
	<th> Vorname </th>
	<th> Nachname </th>
	<th> Mail </th>
	<th> Telefon </th>
	<th></th>
	<th></th>
	</tr>\n";
	
while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->user}" . "</td>"
		. "<td>" . "{$result->firstname}" . "</td>"
		. "<td>" . "{$result->lastname}" . "</td>"
		. "<td>" . "{$result->email}" . "</td>"
		. "<td>" . "{$result->phone}" . "</td>"
		. "<form action='index.php?section=workplace2' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_userid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='select' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
echo "</table><br /><br />";
?>
