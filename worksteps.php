<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- worksteps.php                                 (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<h1>Verwaltung Arbeitsschritte</h1>

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
$myid = $_POST['id'];
$myshort = $_POST['short'];
$mybudget = $_POST['budget'];
$mydescription = $_POST['description'];

if (isset($_POST['new'])) {
	$query = $mysqli->query ("	INSERT INTO worksteps (id, short, budget, description)
								VALUES				('$myid', '$myshort', $mybudget, '$mydescription')");

} elseif (isset($_POST['delete'])) {
	$query = $mysqli->query ("DELETE FROM worksteps WHERE id='$myid'");
	
} elseif (isset($_POST['change'])) {
	$query = $mysqli->query ("UPDATE worksteps SET
		 short='$myshort',
		 budget='$mybudget',
		 description='$mydescription'
		 WHERE id='$myid'");
} else {
	echo "";
}


//-----------------------------------------------------------------------------------
// show worksteps-table                                                      ---
//-----------------------------------------------------------------------------------
$query = $mysqli->query ("SELECT id, short, budget, description FROM worksteps");

echo "<table class='sqltable' border='0' cellspacing='0' cellpadding='2' >\n";

echo "<tr>
	<th> ID </th>
	<th> K&uumlrzel </th>
	<th> Budget </th>
	<th> Beschreibung </th>
	<th></th>
	<th></th>
	<th></th>
	<th></th>
	<th></th>
	</tr>\n";

while ($result = $query->fetch_object())
	{
	echo "<tr><td>" . "{$result->id}" . "</td>"
		. "<td>" . "{$result->short}" . "</td>"
		. "<td>" . "{$result->budget}" . "h</td>"
		. "<td>" . "{$result->description}" . "</td>"
		. "<form action='index.php?section=worksteps' method='post'>" 
			. "<td>" . "<input type='hidden' id='uid1' name='r_id' value=" . "'{$result->id}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid2' name='r_short' value=" . "'{$result->short}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid3' name='r_budget' value=" . "'{$result->budget}'" . "></td>"
			. "<td>" . "<input type='hidden' id='uid4' name='r_description' value=" . "'{$result->description}'" . "></td>"
			. "<td>" . "<input class='css_btn_class' type='submit' value='edit' />" . "</td>"
		. "</form>"
		. "</tr>";
	}
	
echo "</table><br /><br />";

?>
<form action="index.php?section=worksteps" method="post">

	<table>
    	<tr>
         	<td>ID: </td>
        	<td><input type="text" name="id" size="20" value="<?php echo $_POST["r_id"]; ?>" maxlength="30" tabindex="1"/></td>
        	<td>Beschreibung: </td>
        	<td><input type="text" name="description" size="40" value="<?php echo $_POST["r_description"]; ?>" maxlength="64" tabindex="3"/></td>
        </tr><tr>
	       	<td>K&uumlrzel: </td>
        	<td><input type="text" name="short" size="20" value="<?php echo $_POST["r_short"]; ?>" maxlength="30" tabindex="2"/></td>
        	<td>Budget: </td>
        	<td><input type="number" min="0" step="0.1" name="budget" size="20" value="<?php echo $_POST["r_budget"]; ?>" maxlength="16" tabindex="4"/> Stunden</td>
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
	Hinweis: Sowohl ID als auch K&uumlrzel m&uumlssen eindeutig sein!

</form>

<?php
$result->close();
$mysqli -> close();
?>

