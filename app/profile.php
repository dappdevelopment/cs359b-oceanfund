<?php 
	
	$htmlTitle = "Profile";
	$pageTitle = "My Profile";
	$styles = ["css/profile.css"];
	$scripts = ["js/profile.js"];

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

		<div class="left-panel">
			
			<h3 class="user-name">Rohan Dhar</h3>
			<div class="user-id">0xf22bf89389d389nd289nd389n2d8d</div>
			<img class="user-image" src="img/user.jpg">
			<label class="user-change-image">Change Image</label>
			
			<h3 class="profile-sub-head user-funds-head">Withdrawable Funds</h3>
			<div class="user-funds">7 ETH</div>	
			<button class="ui-btn ui-btn-green" id="withdraw-funds">Withdraw Funds <img src="img/right-arrow.png"></button>

		</div><div class="right-panel">			
			<h3 class="profile-sub-head" id="user-pools-head">Your Pools</h3>			
			<h4 class="info-head" id="no-pools-info-head">You don't have any pools yet.</h4>	
			<a href="createPool.php"><button class="ui-btn" id="create-pool">Create Your Pool <img src="img/right-arrow.png"></button></a>
			<h3 class="profile-sub-head" id="invested-head">Your Investments</h3>			
			<h4 class="info-head" id="investments-info-head">You curent have <span>2</span> investments.</h4>	
			
			<div class="ui-pool" id="pool-1">
				<div class="ui-pool-image"></div>
				<div class="ui-pool-details">
					<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>				
					<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
					<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
					<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>					
					<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
				</div>
			</div><div class="ui-pool" id="pool-2">
				<div class="ui-pool-image"></div>
				<div class="ui-pool-details">
					<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
					<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
					<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
					<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
					<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
				</div>
			</div>
			
			<a href="investPool.php"><button class="ui-btn ui-btn-yellow" id="make-investment">Make A New Investment <img src="img/right-arrow.png"></button></a>

		</div>

		<?php require 'struct/footer.php'; ?>
	</body>
</html>