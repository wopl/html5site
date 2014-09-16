<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- user.php                                      (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

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

if (isset($_POST['new'])) {
	$myuser = $_POST['username'];
	$myfirstname = $_POST['vorname'];
	$mylastname = $_POST['nachname'];
	$query = $mysqli->query ("INSERT INTO user (user, firstname, lastname) VALUES ('$myuser', '$myfirstname', '$mylastname')");
} elseif (isset($_POST['delete'])) {
	$myuserid = $_POST['userid'];
	$query = $mysqli->query ("DELETE FROM user WHERE id='$myuserid'");
} elseif (isset($_POST['change'])) {
	$myuserid = $_POST['userid'];
	$myuser = $_POST['username'];
	$myfirstname = $_POST['vorname'];
	$mylastname = $_POST['nachname'];
	$query = $mysqli->query ("UPDATE user SET user='$myuser', firstname='$myfirstname', lastname='$mylastname' WHERE id='$myuserid'");
} else {
	echo "";
}


//-----------------------------------------------------------------------------------
// show user-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, user, firstname, lastname FROM user");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

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
		. "<form action='index.php?section=user' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_userid' value=" . "{$result->id}" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_username' value=" . "{$result->user}" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_firstname' value=" . "{$result->firstname}" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_lastname' value=" . "{$result->lastname}" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
echo "</table><br />";
?>

<form action="index.php?section=user" method="post">

	<table>
    	<tr>
         	<td>User-ID: </td>
        	<td><input type="text" name="userid" size="20" value="<?php echo $_POST["r_userid"]; ?>" maxlength="30" readonly/></td>
        </tr><tr>
	       	<td>User-Name: </td>
        	<td><input type="text" name="username" size="20" value="<?php echo $_POST["r_username"]; ?>" maxlength="30" /></td>
        </tr><tr>
        	<td>Vorname: </td>
        	<td><input type="text" name="vorname" size="20" value="<?php echo $_POST["r_firstname"]; ?>" maxlength="30" /></td>
        </tr><tr>
        	<td>Nachname: </td>
        	<td><input type="text" name="nachname" size="20" value="<?php echo $_POST["r_lastname"]; ?>" maxlength="30" /></td>
        </tr>
    </table>
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='cancel' type='submit' value='cancel' /></td>
 		<td><input class='css_btn_class' name='delete' type='submit' value='delete' /></td>
 		<td><input class='css_btn_class' name='new' type='submit' value='new' /></td>
 		<td><input class='css_btn_class' name='change' type='submit' value='change' /></td>
        </tr>
    </table>

</form>

<?php
$result->close();
$mysqli -> close();
?>

