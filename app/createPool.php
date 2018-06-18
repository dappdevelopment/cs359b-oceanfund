<?php 
	
	$pageTitle = "Create a New Pool";
	$htmlTitle = "Create Pool";
	$styles = ["css/createPool.css"];
	$scripts = ["js/createPool.js"];

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
		<div class="ui-text-banner">
			Create a new pool by filling in the details about name, description and the interest rate you'd be willing to pay whenever an investor liquidates, and the level of authenticity you'd like for your pool!
		</div>

		<div class="image-panel">
			<img class="image-panel-image" src="img/defaultBillboard.png">
			<label class="image-panel-change">Change Image</label>
		</div><div class="details-panel">
			<div class="ques" id="ques-1">
				<div class="ques-main">a. What would you like to name your pool? </div>
				<div class="ques-sub">Don't worry, you can use special characters.</div>
				<input type="text" class="ui-text-input ques-ans" placeholder="Pool's name...">
			</div>			

			<div class="ques" id="ques-2">
				<div class="ques-main">b. What is your pool about? </div>
				<div class="ques-sub">Give a description of your pool.</div>
				<input type="text" class="ui-text-input ques-ans" placeholder="About your pool...">
			</div>			

			<div class="ques" id="ques-3">
				<div class="ques-main">c. What is the interest rate you'd offer?</div>
				<div class="ques-sub">The interest rate you'd be willing to offer investors upon liquidation by another investor (Recomended ~ 0.1 - 0.5%).</div>
				<input type="text" id="ques-interest" class="ui-text-input ques-ans" placeholder="The rate of interest...">
			</div>			

			<div class="ques" id="ques-4">
				<div class="ques-main">d. How many investors would you like? </div>
				<div class="ques-sub">The number of investors you'd like for your pool to have.<br>(Recomended ~ 1-10)</div>
				<input type="text" class="ui-text-input ques-ans" placeholder="Number of Investors...">
			</div>			

			<div class="ques" id="ques-5">
				<div class="ques-main">e. Would you like a custom link for your pool? </div>
				<div class="ques-sub">You can skip this one if you want, we'll assign you one on our own!</div>
				<span id="ques-link-span">oceanfund.com/</span><input type="text" class="ui-text-input ques-ans" id="ques-link" placeholder="">
			</div>			

			<button class="ui-btn" id="create-pool">Create your pool <img src="img/right-arrow.png"></button>

		</div>
	
		<?php require 'struct/footer.php'; ?>

	</body>
</html>