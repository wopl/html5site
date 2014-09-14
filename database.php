<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- database.php                                  (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

database
<br />

<?php
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
?>

<?php
echo "Die Seite wurde ";
echo $row["clicks"];
echo " Mal angesehen";
?>

<?php
mysql_close($conn);
?>