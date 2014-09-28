<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- workplace4.php                                (c) Wolfram Plettscher 09/2014 -->
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
$mystepid	= $_POST['r_stepid'];
$mytimeid	= $_POST['r_timeid'];
$mydate		= $_POST['t_date'];
$mystart	= $_POST['t_start'];
$myend		= $_POST['t_end'];

if (isset($_POST['new'])) {
	$query = $mysqli->query ("	INSERT INTO timerecord
								(custid, custshort, userid, usershort, stepid, stepshort, t_date, t_start, t_end)
								VALUES
								('$mycustid', 'abc', '$myuserid', 'abc', '$mystepid', 'abc', '$mydate', '$mystart', '$myend')");

} elseif (isset($_POST['delete'])) {
	$query = $mysqli->query ("DELETE FROM timerecord WHERE id='$mytimeid'");

} elseif (isset($_POST['change'])) {
	$query = $mysqli->query ("UPDATE timerecord SET
		 t_date='$mydate',
		 t_start='$mystart',
		 t_end='$myend'
		 WHERE id='$mytimeid'");

} elseif (isset($_POST['start'])) {
	$query = $mysqli->query ("	INSERT INTO timerecord
								(custid, custshort, userid, usershort, stepid, stepshort, t_date, t_start, t_end)
								VALUES
								('$mycustid', 'def', '$myuserid', 'def', '$mystepid', 'def', DATE(NOW()), TIME(NOW()), '$myend')");

	$query = $mysqli->query ("UPDATE step2work SET status='gestartet' 
							  WHERE workid = '$mycustid'
							  AND   stepid = '$mystepid'");

// "end now" button pressed
// - check, if an open record from this day exists, then update end time
// - if no such record exists, then insert a new record with missing start time
// - update status of step2work table
} elseif (isset($_POST['stop']) || isset($_POST['pause'])) {
	$query = $mysqli->query ("SELECT id FROM timerecord
							WHERE custid = '$mycustid'
							AND	  userid = '$myuserid'
							AND   stepid = '$mystepid'
							AND   t_date = DATE(NOW())
							AND   t_end  = '00:00:00'");		

	if ($result = $query->fetch_object()) {
//		echo "ID = $result->id";
		$query = $mysqli->query ("UPDATE timerecord SET t_end = TIME(NOW())
								  WHERE id = '$result->id'");
	} else {
//		echo "no record found";
		$query = $mysqli->query ("	INSERT INTO timerecord
									(custid, custshort, userid, usershort, stepid, stepshort, t_date, t_start, t_end)
									VALUES
									('$mycustid', 'def', '$myuserid', 'def', '$mystepid', 'def', DATE(NOW()), '$mystart', TIME(NOW()) )");
	}

	// after having updated the timerecord entry, now update the status
	if (isset($_POST['stop'])) {
		// set status "beendet"
		$query = $mysqli->query ("UPDATE step2work SET status='beendet' 
								  WHERE workid = '$mycustid'
								  AND   stepid = '$mystepid'");
	} else {
		// this happens only if 'pause' buton has pressed
		// set status "gestartet"
		// ... it should already have this startus, except this is the first entry on time-record
		// ... for simplicity we always do the update
		$query = $mysqli->query ("UPDATE step2work SET status='gestartet' 
								  WHERE workid = '$mycustid'
								  AND   stepid = '$mystepid'");
	}

//} else {
//	echo "";
}
//----------------------------------------------------------------------------------
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
// show selected workstep                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT short, description, status FROM step2work
						  WHERE workid = '$mycustid'
						  AND   stepid = '$mystepid'");
$result = $query->fetch_object();
$query2 = $mysqli->query ("SELECT budget FROM worksteps
						  WHERE id = '$mystepid'");
$result2 = $query2->fetch_object();

echo "<b>" .
	 "$mystepid" . 
	 " " .
	 "$result->short" .
	 "</b> " .
	 " Status: <b>" .
	 "$result->status" .
	 "</b> Budget: " .
	 "$result2->budget" .
	 " Stunden" .
	 "<br />";
//echo "<font size='+1'>";
echo "<b>" .
	 "$result->description" .
	 "</b>" .
	 "<br /><br />";
//echo "</font>";

?>
<form action="index.php?section=workplace4" method="post">
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='start' type='submit' value='begin now' /></td>
 		<td><input class='css_btn_class' name='stop' type='submit' value='end now' /></td>
 		<td><input class='css_btn_class' name='pause' type='submit' value='pause now' /></td>
		<td><input type='hidden' id='uid1' name='r_userid' value='<?php echo "$myuserid" ?>'/></td>
		<td><input type='hidden' id='uid2' name='r_custid' value='<?php echo "$mycustid" ?>'/></td>
		<td><input type='hidden' id='uid3' name='r_stepid' value='<?php echo "$mystepid" ?>'/></td>
        </tr>
    </table>
</form>
<?php

//-----------------------------------------------------------------------------------
// show timerecords
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, t_date, t_start, t_end FROM timerecord
						  WHERE custid='$mycustid'
						  AND   userid='$myuserid'
						  AND   stepid='$mystepid'
						  ORDER BY t_date DESC, t_start DESC, t_end DESC");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> Datum </th>
	<th> Kommen </th>
	<th> Gehen </th>
	<th></th>
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
	$mydate = $result->t_date;
//	$mydate = date ('d.m.Y', strtotime($result->t_date));
//	echo "$mydate";

	//-----------------------------------------------------------------------------------
	// show worksteps details                                                      ---
	//-----------------------------------------------------------------------------------
	echo "<tr><td>" . "$mydate" . "</td>"
		. "<td>" . "{$result->t_start}" . "</td>"
		. "<td>" . "{$result->t_end}" . "</td>"
		. "<form action='index.php?section=workplace4' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_userid' value=" . "'$myuserid'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_custid' value=" . "'$mycustid'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_stepid' value=" . "'$mystepid'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_timeid' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid5' name='r_date' value=" . "'{$result->t_date}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid6' name='r_start' value=" . "'{$result->t_start}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid7' name='r_end' value=" . "'{$result->t_end}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>";

	}
	
echo "</table><br /><br >";
?>

<form action="index.php?section=workplace4" method="post">

	<table>
    	<tr>
         	<td>Datum: </td>
        	<td><input type="date" name="t_date" size="20" value="<?php echo $_POST["r_date"]; ?>" maxlength="30" tabindex="1"/></td>
        	<td>Kommen: </td>
        	<td><input type="time" name="t_start" size="20" value="<?php echo $_POST["r_start"]; ?>" maxlength="64" tabindex="2"/></td>
        </tr><tr>
	       	<td></td>
        	<td></td>
        	<td>Gehen: </td>
        	<td><input type="time" name="t_end" size="20" value="<?php echo $_POST["r_end"]; ?>" maxlength="64" tabindex="3"/></td>
        </tr>
    </table>

	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='cancel' type='submit' value='cancel' /></td>
 		<td><input class='css_btn_class' name='delete' type='submit' value='delete' /></td>
 		<td><input class='css_btn_class' name='new' type='submit' value='new' /></td>
 		<td><input class='css_btn_class' name='change' type='submit' value='change' /></td>
		<td><input type='hidden' id='uid1' name='r_userid' value='<?php echo "$myuserid" ?>'/></td>
		<td><input type='hidden' id='uid2' name='r_custid' value='<?php echo "$mycustid" ?>'/></td>
 		<td><input type='hidden' id='uid3' name='r_stepid' value='<?php echo "$mystepid" ?>'/></td>
 		<td><input type='hidden' id='uid4' name='r_timeid' value='<?php echo "$mytimeid" ?>'/></td>
       </tr>
    </table>

</form>


<form action="index.php?section=workplace3" method="post">
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='back' type='submit' value='back' /></td>
		<td><input type='hidden' id='uid1' name='r_userid' value='<?php echo "$myuserid" ?>'/></td>
		<td><input type='hidden' id='uid2' name='r_custid' value='<?php echo "$mycustid" ?>'/></td>
        </tr>
    </table>
</form>
