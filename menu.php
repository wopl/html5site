<!-- ---------------------------------------------------------------------------- -->
<!--                                                                              -->
<!-- menu.php                                      (c) Wolfram Plettscher 09/2014 -->
<!--                                                                              -->
<!-- ---------------------------------------------------------------------------- -->

<ul>
   <?php
		if ($section == "home"){
			   echo "<li class='active'>";
		} else {
			   echo "<li>";
		}
		echo "<a href='index.php?section=home'><span>Home</span></a></li>";
   ?>

   <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Product 1</span></a>
            <ul>
               <li><a href='#'><span>Sub Product11</span></a></li>
               <li class='active last'><a href='#'><span>Sub Product12</span></a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'><span>Product 2</span></a>
            <ul>
               <li><a href='#'><span>Sub Product21</span></a></li>
               <li class='last'><a href='#'><span>Sub Product22</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
<!--   
   <li><a href='index.php?section=about'><span>About</span></a></li>
   <li class='last'><a href='index.php?section=contact'><span>Contact</span></a></li>
-->
   <?php
		if ($section == "about"){
			   echo "<li class='active'>";
		} else {
			   echo "<li>";
		}
		echo "<a href='index.php?section=about'><span>About</span></a></li>";

		if ($section == "contact"){
			   echo "<li class='active'>";
		} else {
			   echo "<li>";
		}
		echo "<a href='index.php?section=contact'><span>Contact</span></a></li>";

		if ($section == "database"){
			   echo "<li class='active last'>";
		} else {
			   echo "<li>";
		}
		echo "<a href='index.php?section=database'><span>Database</span></a></li>";
   ?>
</ul>
