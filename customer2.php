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
//	echo "User-Id: " . 	$myuserid . "<br />";
//	echo "Cust-Id: ". $mycustid . "<br />";

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
echo "<font size='+1'>";
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
echo "</font>";
?>

<br />
<table width="1000">
	<tr valign="top">
    	<td>
        	<h2>Monteure</h2>
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
        	<h2>Arbeitsschritte</h2>
            <form action="index.php?section=customer2" method="post">
                <table>
                    <tr>
                    <td><input class='css_btn_class' name='newstep' type='submit' value='add' /></td>
                    <td><select width="400">
                    	<option value="AS1">Arbeitsschritt 1</option>
                     	<option value="AS2">Arbeitsschritt 2</option>
                     	<option value="AS3">Arbeitsschritt 3</option>
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
					. "<form action='index.php?section=customer' method='post'>" 
						. "<td>" . "<input type='hidden' id='uid1' name='r_custid' value=" . "'{$result->id}'" . "></td>"
						. "<td>" . "<input class='css_btn_class' type='submit' value='delete' />" . "</td>"
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

