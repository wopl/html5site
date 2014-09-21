<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- user.php                                      (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Verwaltung Benutzer / Monteure</h1>

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

	$myuserid = $_POST['userid'];
	$myuser = $_POST['username'];
	$myfirstname = $_POST['vorname'];
	$mylastname = $_POST['nachname'];
	$myemail = $_POST['email'];
	$myphone = $_POST['phone'];

if (isset($_POST['new'])) {
	$query = $mysqli->query ("	INSERT INTO user	(user, firstname, lastname, email, phone)
								VALUES				('$myuser', '$myfirstname', '$mylastname', '$myemail', '$myphone')");

} elseif (isset($_POST['delete'])) {
	$query = $mysqli->query ("DELETE FROM user WHERE id='$myuserid'");
	$query = $mysqli->query ("DELETE FROM user2work WHERE userid='$myuserid'");

} elseif (isset($_POST['change'])) {
	$query = $mysqli->query ("UPDATE user SET
		 user='$myuser',
		 firstname='$myfirstname',
		 lastname='$mylastname',
		 email='$myemail',
		 phone='$myphone'
		 WHERE id='$myuserid'");
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
	<th></th>
	<th></th>
	<th></th>
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
		. "<form action='index.php?section=user' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_userid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_username' value=" . "'{$result->user}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_firstname' value=" . "'{$result->firstname}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_lastname' value=" . "'{$result->lastname}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid5' name='r_email' value=" . "'{$result->email}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid6' name='r_phone' value=" . "'{$result->phone}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
echo "</table><br /><br />";
?>

<form action="index.php?section=user" method="post">

	<table>
    	<tr>
         	<td>User-ID: </td>
        	<td><input type="text" name="userid" size="20" value="<?php echo $_POST["r_userid"]; ?>" maxlength="30" tabindex="1" readonly/></td>
        	<td>Vorname: </td>
        	<td><input type="text" name="vorname" size="40" value="<?php echo $_POST["r_firstname"]; ?>" maxlength="64" tabindex="3"/></td>
        </tr><tr>
	       	<td>User-Name: </td>
        	<td><input type="text" name="username" size="20" value="<?php echo $_POST["r_username"]; ?>" maxlength="30" tabindex="2"/></td>
        	<td>Nachname: </td>
        	<td><input type="text" name="nachname" size="40" value="<?php echo $_POST["r_lastname"]; ?>" maxlength="64" tabindex="4"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>E-Mail: </td>
        	<td><input type="text" name="email" size="40" value="<?php echo $_POST["r_email"]; ?>" maxlength="64" tabindex="5"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>Telefon: </td>
        	<td><input type="text" name="phone" size="40" value="<?php echo $_POST["r_phone"]; ?>" maxlength="64" tabindex="6"/></td>
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

