<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- customer.php                                  (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

customer
<br />

<table class="sqltable">
	<tr><th>Lorem</th><th>ipsum</th></tr>
	<tr><th>Lorem</th><th>ipsum</th></tr>
	<tr><th>Lorem</th><th>ipsum</th></tr>
	<tr><th>Lorem</th><th>ipsum</th></tr>
</table>

<?php
include "mysql/credentials.inc";

$mysqli = new mysqli($host,$username,$password,$database);

// Verbindung prüfen
if (mysqli_connect_errno()) {
	printf ("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
	exit();
}

$query = $mysqli->query ("SELECT clicks FROM counter WHERE id='home'");
$result = $query->fetch_object();
	
echo "<br>Die Seite wurde ";
echo "{$result->clicks}";
echo " Mal angesehen<br>";

$mysqli->query ("UPDATE counter SET clicks = clicks+1 WHERE id='home'");
printf ("Updated {$mysqli->affected_rows} rows.<br>");

//-----------------------------------------------------------------------------------
// Ausgabe der User-Tabelle                                                       ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, user, firstname, lastname FROM user");

echo "<table class='sqltable' border='0'>\n";

echo "<tr>
	<th> ID </th>
	<th> User </th>
	<th> Vorname </th>
	<th> Nachname </th>
	</tr>\n";
	
while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->user}" . "</td>"
		. "<td>" . "{$result->firstname}" . "</td>"
		. "<td>" . "{$result->lastname}" . "</td>"
		. "<form action='index.php?section=database' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid' name='myline' value=" . "{$result->user}" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>\n";
	}
echo "</table><br />";

echo "<br>was ist das denn hier<br>";

?>
hug0
<form action="index.php?section=database" method="post">
	Ihr Vorname: <br />
	<input type="text" name="vorname" size="20" value="<?php echo $_POST["myline"]; ?>" maxlength="30" />
    <br />
	Ihr Nachname: <br />
	<input type="text" name="nachname" size="20" maxlength="30" />
	<br />
	<input type="submit" value="send" />
    
    <br />test<br />

	<?php
	echo "hugo<br />";
	echo $_SERVER["PHP_SELF"] . "<br />";
	echo $section . "<br />";
	echo "emil<br />";
	echo $_POST["vorname"] . "<br />";
	echo "myline: " . $_POST["myline"] . "<br />";
	?>
</form>

<?php

$result->close();

?>



<?php

$mysqli -> close();

?>

