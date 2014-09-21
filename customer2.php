<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- customer2.php                                 (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Zuordnung Monteure / Arbeitsschritte</h1>
<form action="index.php?section=customer" method="post">
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='back' type='submit' value='back' /></td>
        </tr>
    </table>
</form>

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

	$mycustid		= $_POST['r_custid'];	
	$myuserid		= $_POST['r_userid'];
	$mystepid		= $_POST['r_stepid'];

    $query = $mysqli->query ("SELECT short, kunde, country, zip, town, street, number, 
							locremark, contact, phone, active, flags FROM workplace WHERE id='$mycustid'");
    $result = $query->fetch_object();

	if (isset($_POST['newworker'])) {
	    $nwquery = $mysqli->query ("SELECT user, firstname, lastname 
									FROM user WHERE id='$myuserid'");
	    $nwresult = $nwquery->fetch_object();
		$insert = $mysqli->query ("INSERT INTO user2work
								(workid, userid, user, firstname, lastname)
								VALUES
								('$mycustid', '$myuserid', '$nwresult->user', '$nwresult->firstname', '$nwresult->lastname')");

	} elseif (isset($_POST['deleteworker'])) {
		$delquery = $mysqli->query ("DELETE FROM user2work WHERE workid='$mycustid' AND userid='$myuserid'");

	} elseif (isset($_POST['newstep'])) {
	    $nsquery = $mysqli->query ("SELECT short, description 
									FROM worksteps WHERE id='$mystepid'");
	    $nsresult = $nsquery->fetch_object();
		$insert = $mysqli->query ("INSERT INTO step2work
								(workid, stepid, short, description)
								VALUES
								('$mycustid', '$mystepid', '$nsresult->short', '$nsresult->description')");

	} elseif (isset($_POST['deletestep'])) {
		$delquery = $mysqli->query ("DELETE FROM step2work WHERE workid='$mycustid' AND stepid='$mystepid'");

	}
	
//-----------------------------------------------------------------------------------
// show customer data
//-----------------------------------------------------------------------------------

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
	 "<br />";
//echo "</font>";
?>

<br />
<table width="1000">
	<tr valign="top">
    	<td>
        	<h3>Monteure</h3>
            <form action="index.php?section=customer2" method="post">
                <table>
                    <tr>
                    <td><input class='css_btn_class' name='newworker' type='submit' value='add' /></td>
					<td><input type='hidden' id='uid1' name='r_custid' value='<?php echo "$mycustid" ?>' /></td>
                    <td><select name='r_userid' width="400">
					<?php
                    // fill dropbox with database values
                    // <option value="MA1">Mitarbeiter 1</option>
                    $query = $mysqli->query ("SELECT id, user, firstname, lastname FROM user");
                    while ($result = $query->fetch_object())
                        {
                        echo "<option value=" . "'{$result->id}'" . ">" .
                             "{$result->id} {$result->user} -- {$result->firstname} {$result->lastname}" .
                             "</option>";
                        }
                    ?>
                    </select></td>
                    </tr>
                </table>
            </form>
			<?php
            $query = $mysqli->query ("SELECT userid, user, firstname, lastname FROM user2work WHERE workid = '$mycustid' ");
            
            echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >";
            echo "<tr>
                <th> ID </th>
                <th> User </th>
                <th> Vorname </th>
                <th> Nachname </th>
                </tr>\n";
            while ($result = $query->fetch_object())
                {
                echo "<tr><td>" . "{$result->userid}" . "</td>"
                    . "<td>" . "{$result->user}" . "</td>"
                    . "<td>" . "{$result->firstname}" . "</td>"
                    . "<td>" . "{$result->lastname}" . "</td>"
					. "<form action='index.php?section=customer2' method='post'>" 
						. "<td>" . "<input type='hidden' id='uid1' name='r_custid' value=" . "$mycustid" . "></td>"
						. "<td>" . "<input type='hidden' id='uid2' name='r_userid' value=" . "$result->userid" . "></td>"
						. "<td>" . "<input class='css_btn_class' name='deleteworker' type='submit' value='delete' />" . "</td>"
					. "</form>"
                	. "</tr>\n";
                 };
            echo "</table>";	
            ?>

        </td><td>
        	<h3>Arbeitsschritte</h3>
            <form action="index.php?section=customer2" method="post">
                <table>
                    <tr>
                    <td><input class='css_btn_class' name='newstep' type='submit' value='add' /></td>
					<td><input type='hidden' id='uid1' name='r_custid' value='<?php echo "$mycustid" ?>' /></td>
                    <td><select name='r_stepid' width="400">
					<?php
                    // fill dropbox with database values
                    // <option value="MA1">Mitarbeiter 1</option>
                    $query = $mysqli->query ("SELECT id, short, description FROM worksteps");
                    while ($result = $query->fetch_object())
                        {
                        echo "<option value=" . "'{$result->id}'" . ">" .
                             "{$result->id} {$result->short} -- {$result->description}" .
                             "</option>";
                        }
                    ?>
                    </select></td>
                    </tr>
                </table>
            </form>
            <?php
            $query = $mysqli->query ("SELECT stepid, short, description FROM step2work WHERE workid = '$mycustid' ");
            
            echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >";
            echo "<tr>
                <th> ID </th>
                <th> K&uumlrzel </th>
                <th> Beschreibung </th>
                </tr>\n";
            while ($result = $query->fetch_object())
                {
                echo "<tr><td>" . "{$result->stepid}" . "</td>"
                    . "<td>" . "{$result->short}" . "</td>"
                    . "<td>" . "{$result->description}" . "</td>"
					. "<form action='index.php?section=customer2' method='post'>" 
						. "<td>" . "<input type='hidden' id='uid1' name='r_custid' value=" . "$mycustid" . "></td>"
						. "<td>" . "<input type='hidden' id='uid2' name='r_stepid' value=" . "$result->stepid" . "></td>"
						. "<td>" . "<input class='css_btn_class' name='deletestep' type='submit' value='delete' />" . "</td>"
					. "</form>"
                    . "</tr>\n";
                };
            echo "</table>";	
            ?>

        </td>
    </tr>
</table>

<form action="index.php?section=customer" method="post">
	<br />
	<table>
    	<tr>
 		<td><input class='css_btn_class' name='back' type='submit' value='back' /></td>
        </tr>
    </table>
</form>

<?php
//$result->close();
$mysqli -> close();
?>

