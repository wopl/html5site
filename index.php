<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- index.php                                     (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<?php
	if (isset ($_GET["section"]))
		{
			$section = $_GET["section"];
		} else {
			$section = "";
		}
?>


<html>
    <head>
		<!-- following lines are included for menu style -->
        <link rel="stylesheet" href="css/menu.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
        
        <title>HTML5 page</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">

		<!-- add script for zebra-table -->
		<sript src="jquery.js"></script>
        <script>
		$(function(){
//			$('#cssmenu').hide().fadeIn(4000);
			$('.sqltable tr:first-child').addClass('sqltableone');
			$('.sqltable tr:nth-child(even)').addClass('sqltableeven');
			$('.sqltable tr:nth-child(2n+3)').addClass('sqltableodd');
			});
		</script>

<style type="text/css">
.css_btn_class {
	font-size:12px;
	font-family:Arial;
	font-weight:normal;
	-moz-border-radius:19px;
	-webkit-border-radius:19px;
	border-radius:19px;
	border:1px solid #268a16;
	padding:0px 14px;
	text-decoration:none;
	background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
	background:-ms-linear-gradient( top, #77d42a 5%, #5cb811 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #77d42a), color-stop(100%, #5cb811) );
	background-color:#77d42a;
	color:#0;
	display:inline-block;
 	-webkit-box-shadow:inset 1px 1px 0px 0px #caefab;
 	-moz-box-shadow:inset 1px 1px 0px 0px #caefab;
 	box-shadow:inset 1px 1px 0px 0px #caefab;
}.css_btn_class:hover {
	background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
	background:-ms-linear-gradient( top, #5cb811 5%, #77d42a 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #5cb811), color-stop(100%, #77d42a) );
	background-color:#5cb811;
}.css_btn_class:active {
	position:relative;
	top:1px;
}
/* This css button was generated by css-button-generator.com */
</style>

    </head>

<!-- ---------------------------------------------------------------------------- -->
<!-- body                                                                         -->
<!-- ---------------------------------------------------------------------------- -->
    <body>

        <div id="wrapper">
            <div id="header">
                header
            </div>
            
            <div id="cssmenu">
				<?php include ("menu.php"); ?>
            </div>
            
            <div id="contentbody">
				<?php include ("sites.php"); ?>
            </div>
            
        </div>

        <div id="footer">
            &copy; Wolfram Plettscher 2014
        </div>
    
    </body>

</html>
