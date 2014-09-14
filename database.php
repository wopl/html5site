<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- database.php                                  (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

database
<br />

<!--

$username="db11197344-root";
$password="linux4me";
$database="db11197344-protrack";
$host="localhost";
$conn=mysql_connect('localhost','db11197344-root','linux4me');
mysql_select_db($database);

$select="SELECT clicks FROM counter WHERE id='home'";
$result=mysql_query($select);
$row=mysql_fetch_array($result);
$update="UPDATE counter SET clicks = clicks+1 WHERE id='home'";
$change=mysql_query($update);

echo "Die Seite wurde ";
echo $row["clicks"];
echo " Mal angesehen";

mysql_close($conn);

-->

<?php
$mysqli = new mysqli('localhost','db11197344-root','linux4me','db11197344-protrack');

// Verbindung prüfen
if (mysqli_connect_errno()) {
	printf ("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
	exit();
}

$query = $mysqli->query ("SELECT clicks FROM counter WHERE id='home'");
$result = $query->fetch_object();
	
echo "Die OO-Seite wurde ";
echo "{$result->clicks}";
echo " Mal angesehen";

$mysqli->query ("UPDATE counter SET clicks = clicks+1 WHERE id='home'");

printf ("\n\nUpdated\n");

$mysqli -> close();
?>
