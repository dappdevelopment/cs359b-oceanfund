<?php 
	
	$pageTitle = "";
	$htmlTitle = "Home";
	$styles = ["css/home.css"];	

	$activeMenuItem = 1;		
	$activeSubMenuItem = 1;		

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
		<div class="ui-text-banner home-text">
			OceanFund is an investment vehicle where users can stash their extra unused ETH for future returns. The interest rate however, is <a href="http://localhost/oceanFund">dynamic <img src="img/info.png" class='info-icon'> </a> and depends on the time for which the money is invested.
		</div>
		
		<div class="feature" id="feature-1">
			
			<img class="feature-circles" src="img/circlesBlue.jpg" >
			
			<h2 class="feature-head"> <img src="img/add.png" class="feature-head-icon"> Create and Customize Your Own Pool.</h2>
			<div class="feature-desc">
				Want to create your own investment pool and be the first investor? Create a new pool with your own interest rate and cap on number of investors! Create your own pool here.				
			</div>
			<a href="createPool.php"><button class="ui-btn feature-act">Create Your Own Pool <img src="img/right-arrow.png"></button></a>
		</div>
		<div class="feature feature-right" id="feature-2">
			
			<img class="feature-circles" src="img/circlesYellow.jpg" >
			
			<h2 class="feature-head"> <img src="img/wait.png" class="feature-head-icon">Invest and Wait.</h2>			
			<div class="feature-desc">
				Want to create your own investment pool and be the first investor? Create a new pool with your own interest rate and cap on number of investors! Create your own pool here.
			</div>
			 <a href="investPool.php"><button class="ui-btn ui-btn-yellow feature-act ">Make an Investment <img src="img/right-arrow.png"></button></a> 
		</div>
		<div class="feature" id="feature-3">
			
			<img class="feature-circles" src="img/circlesGreen.jpg" >
			
			<h2 class="feature-head"> <img src="img/more.png" class="feature-head-icon">More Coming Soon!</h2>
			<div class="feature-desc">
				Keep tuned for more. This is being actively developed at OceanFund. You can reach out to us with feedback and suggestions at tkothari@stanford.edu.
			</div>
			<button class="ui-btn ui-btn-green feature-act">View Github <img src="img/right-arrow.png"></button>
		</div>


		<?php require 'struct/footer.php'; ?>
	</body>
</html>