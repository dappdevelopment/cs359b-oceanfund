<?php 
	
	$htmlTitle = "Mobile";
	$pageTitle = "Mobile";
	$styles = ["css/mobile.css"];

	require "mobileCheck.php";

	if(!isMobile()){
		// header("Location: index.php");
	}

?>
<?php require("struct/info.php"); ?>
<!DOCTYPE html>
<html>
	<?php require 'struct/head.php';?>
	<body>
		<header class='header'>
			<img src="img/logo.png" class="header-logo">
		</header>
		<div class="info"><span class="large"><span class="ocean-fund">OceanFund</span> is currently not availble on mobile devices and tablets. </span><div class="line"></div> Use OceanFund next time you're using your Laptop or Desktop!</div>
	</body>
</html>