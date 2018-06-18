<?php 
	
	$htmlTitle = "Pool Details";
	$pageTitle = "Pool Details";
	$styles = ["css/pool.css"];
	$scripts = ["js/pool.js"];

	$activeMenuItem = 1;		//Possible values - 1, 2, or 3 (Any other yeilds no menu item to be selected)
	$activeSubMenuItem = 1;		//Possible values - 1 or 2	   (Any other yeilds no sub-menu item to be selected)

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
			<img class="pool-image" src="img/defaultBillboard.png" >
			<label class="pool-image-name">oceanfundapp.com/ac19</label>
			<div class="pool-level">Level 5</div>
		</div><div class="right-panel">
			<h2 class="pool-sub-head">Basic Details</h2>

			<div class="pool-details">
				<div class="pool-details-name">Name</div>
				<div class="pool-details-info">AC19</div>
			</div><div class="pool-details">
				<div class="pool-details-name">Investors</div>
				<div class="pool-details-info">10</div>
			</div><div class="pool-details">
				<div class="pool-details-name">Interest</div>
				<div class="pool-details-info">0.5% CI</div>
			</div>
			<div class="pool-details pool-details-long">
				<div class="pool-details-name">Description</div>
				<div class="pool-details-info">This is the best pool you'll come across.</div>
			</div>

			<h2 class="pool-sub-head" id="pattern-head">Holding Pattern</h2>

			<h2 class="info-head">The pool currently consists of <span>5 Investors</span> with <span>1000 OT (~ 100ETH)</span> invested. </h2>
				
			<table class="holding-pattern">
				<tr>				
					<th>Hex</th>
					<th>OceanToken</th>
					<th>Ethereum</th>
					<th>Holding (in %)</th>				
				</tr>
				<tr>
					<td>0xf2hnd48n73874ndn47384d7n3847nd48</td>
					<td>250</td>
					<td>20</td>
					<td>25</td>
				</tr>
				<tr>
					<td>0xf2hnd48n73874ndn47384d7n3847nd48</td>
					<td>250</td>
					<td>20</td>
					<td>25</td>
				</tr>
				<tr>
					<td>0xf2hnd48n73874ndn47384d7n3847nd48</td>
					<td>250</td>
					<td>20</td>
					<td>25</td>
				</tr>
				<tr>
					<td>0xf2hnd48n73874ndn47384d7n3847nd48</td>
					<td>250</td>
					<td>20</td>
					<td>25</td>
				</tr>
				<tr>
					<td>0xf2hnd48n73874ndn47384d7n3847nd48</td>
					<td>250</td>
					<td>20</td>
					<td>25</td>
				</tr>

			</table>

		</div>

		<?php require 'struct/footer.php'; ?>
	</body>
</html>