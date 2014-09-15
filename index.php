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
