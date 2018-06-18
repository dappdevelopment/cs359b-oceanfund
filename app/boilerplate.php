<?php 
	
	$pageTitle = "Boiler Plate"; 		 			// Title displayed in the SUB-HEADER
	$htmlTitle = "Boiler Plate"; 					// Title displayed in Browser Tab
	$styles = ["css/test.css", "css/test2.css"];	// Additional CSS Files to load
	$styles = ["js/test.css", "js/test2.css"];		// Additional JS Files to load

	$activeMenuItem = 1;		//Possible values - 1, 2, or 3 (Any other yeilds no menu item to be selected)
	$activeSubMenuItem = 2;		//Possible values - 1 or 2	   (Any other yeilds no sub-menu item to be selected)

	require "mobileCheck.php";

	if(isMobile()){
		header("Location: mobile.php");
	}
?>
<?php require("struct/info.php"); ?>
<!DOCTYPE html>
<html>
	<?php require 'struct/head.php';?>
	<body>
		<?php require 'struct/header.php';?>
	</body>
</html>