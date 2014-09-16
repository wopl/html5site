<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- home.php                                      (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

home<br />
asdf
as
df
as
df
fd
<br />
asdfdaaf

aa
ff

<form action="index.php?section=home" method="post">
	Ihr Vorname: <br />
	<input type="text" name="vorname" size="20" maxlength="30" />
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
	?>
</form>
