<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- customer.php                                  (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Verwaltung Kunden</h1>

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

	$mycustid		= $_POST['custid'];	
	$myshort		= $_POST['short'];	
	$mycustomer 	= $_POST['customer'];	
	$mycountry		= $_POST['country'];	
	$myzip			= $_POST['zip'];	
	$mytown			= $_POST['town'];	
	$mystreet		= $_POST['street'];	
	$mynumber		= $_POST['number'];	
	$mylocremark	= $_POST['locremark'];	
	$mycontact		= $_POST['contact'];	
	$myphone		= $_POST['phone'];	
	$myactive		= $_POST['active'];	
	if (isset($_POST['active'])) {
		$myactive = '1';
	} else {
		$myactive = '0';
	}
	$myflags		= $_POST['flags'];	

if (isset($_POST['new'])) {
	$query = $mysqli->query ("	INSERT INTO workplace
								(short, kunde, country, zip, town, street,
								 number, locremark, contact, phone, active, flags)
								VALUES
								('$myshort', '$mycustomer', '$mycountry', '$myzip', '$mytown', '$mystreet',
								 '$mynumber', '$mylocremark', '$mycontact', '$myphone', '$myactive', '$myflags')");

} elseif (isset($_POST['delete'])) {
	$query = $mysqli->query ("DELETE FROM workplace WHERE id='$mycustid'");
	$query = $mysqli->query ("DELETE FROM user2work WHERE workid='$mycustid'");

} elseif (isset($_POST['change'])) {
	$query = $mysqli->query ("UPDATE workplace SET
		 short='$myshort',
		 kunde='$mycustomer',
		 country='$mycountry',
		 zip='$myzip',
		 town='$mytown',
		 street='$mystreet',
		 number='$mynumber',
		 locremark='$mylocremark',
		 contact='$mycontact',
		 phone='$myphone',
		 active='$myactive',
		 flags='$myflags'
		 WHERE id='$mycustid'");

//} else {
//	echo "";
}


//-----------------------------------------------------------------------------------
// show user-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, short, kunde, country, zip, town, street, number, locremark, contact, phone, active, flags FROM workplace");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> ID </th>
	<th> K&uumlrzel </th>
	<th> Kunde </th>
	<th> PLZ </th>
	<th> Stadt </th>
	<th> Stra&szlige </th>
	<th> Aktiv </th>
	</tr>\n";
	
while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->short}" . "</td>"
		. "<td>" . "{$result->kunde}" . "</td>"
		. "<td>" . "{$result->country}" . "-" . "{$result->zip}" . "</td>"
		. "<td>" . "{$result->town}" . "</td>"
		. "<td>" . "{$result->street}" . " " . "{$result->number}" . "</td>"
		. "<td>" . "{$result->active}" . "</td>"

		. "<form action='index.php?section=customer' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_custid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_short' value=" . "'{$result->short}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_customer' value=" . "'{$result->kunde}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_country' value=" . "'{$result->country}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid5' name='r_zip' value=" . "'{$result->zip}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid6' name='r_town' value=" . "'{$result->town}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid7' name='r_street' value=" . "'{$result->street}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid8' name='r_number' value=" . "'{$result->number}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid9' name='r_locremark' value=" . "'{$result->locremark}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid10' name='r_contact' value=" . "'{$result->contact}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid11' name='r_phone' value=" . "'{$result->phone}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid12' name='r_active' value=" . "'{$result->active}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid13' name='r_flags' value=" . "'{$result->flags}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "<form action='index.php?section=customer2' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_custid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='select' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
echo "</table><br /><br />";
?>

<form action="index.php?section=customer" method="post">

	<table>
    	<tr>
         	<td>Kunden-ID: </td>
        	<td><input type="text" name="custid" size="20" value="<?php echo $_POST["r_custid"]; ?>" maxlength="30" tabindex="1" readonly/></td>
        	<td>Kunde: </td>
        	<td><input type="text" name="customer" size="40" value="<?php echo $_POST["r_customer"]; ?>" maxlength="64" tabindex="3"/></td>
         	<td>Kontakt: </td>
        	<td><input type="text" name="contact" size="40" value="<?php echo $_POST["r_contact"]; ?>" maxlength="64" tabindex="10"/></td>
        </tr><tr>
	       	<td>K&uumlrzel: </td>
        	<td><input type="text" name="short" size="20" value="<?php echo $_POST["r_short"]; ?>" maxlength="64" tabindex="2"/></td>
        	<td>Land: </td>
        	<td><input type="text" name="country" size="40" value="<?php echo $_POST["r_country"]; ?>" maxlength="64" tabindex="4"/></td>
        	<td>Telefon: </td>
        	<td><input type="text" name="phone" size="40" value="<?php echo $_POST["r_phone"]; ?>" maxlength="64" tabindex="11"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>PLZ: </td>
        	<td><input type="text" name="zip" size="40" value="<?php echo $_POST["r_zip"]; ?>" maxlength="64" tabindex="5"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>Stadt: </td>
        	<td><input type="text" name="town" size="40" value="<?php echo $_POST["r_town"]; ?>" maxlength="64" tabindex="6"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>Stra&szlige: </td>
        	<td><input type="text" name="street" size="40" value="<?php echo $_POST["r_street"]; ?>" maxlength="64" tabindex="7"/></td>
        </tr><tr>
			<td></td>
            <td></td>
        	<td>Nr.: </td>
        	<td><input type="text" name="number" size="40" value="<?php echo $_POST["r_number"]; ?>" maxlength="64" tabindex="8"/></td>
        	<td>Aktiv: </td>
        	<td><input type="checkbox" name="active" size="40" value="" <?php echo (($_POST["r_active"]=='1') ? 'checked' : ''); ?> tabindex="12"/></td>
         </tr><tr>
			<td></td>
            <td></td>
        	<td>Standort: </td>
        	<td><input type="text" name="locremark" size="40" value="<?php echo $_POST["r_locremark"]; ?>" maxlength="64" tabindex="9"/></td>
        	<td>Flags: </td>
        	<td><input type="text" name="flags" size="40" value="<?php echo $_POST["r_flags"]; ?>" maxlength="64" tabindex="13"/></td>
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


