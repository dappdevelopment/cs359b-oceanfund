<?php 
	
	$pageTitle = "Invest in a Pool";
	$htmlTitle = "Invest in a Pool";
	$styles = ["css/investPool.css"];
	$scripts = ["js/velocity.min.js", "js/investPool.js"];

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
		<header class="search-head">
		
		<img id="search-icon" src="img/search.png" ><input class="ui-text-input" id="search-pool" placeholder="Search for Investment Pools ..."></input>
		</header>
		<div class="pool-holder">
			
			<div class="pool-holder-page" id="pool-holder-page-1">
				<div class="pool-holder-page-num"><span>1</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>


			<div class="pool-holder-page" id="pool-holder-page-2">
				<div class="pool-holder-page-num"><span>2</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>


			<div class="pool-holder-page" id="pool-holder-page-3">
				<div class="pool-holder-page-num"><span>3</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-4">
				<div class="pool-holder-page-num"><span>4</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>



			<div class="pool-holder-page" id="pool-holder-page-5">
				<div class="pool-holder-page-num"><span>5</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-6">
				<div class="pool-holder-page-num"><span>6</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-7">
				<div class="pool-holder-page-num"><span>7</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-8">
				<div class="pool-holder-page-num"><span>8</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-9">
				<div class="pool-holder-page-num"><span>9</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
			</div>

			<div class="pool-holder-page" id="pool-holder-page-10">
				<div class="pool-holder-page-num"><span>10</span> of 10</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">AC19</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.5% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
					</div>
				</div>
				<div class="ui-pool">
					<div class="ui-pool-image"></div>
					<div class="ui-pool-details">
						<div class="ui-pool-name">TK04</div> <div class="ui-pool-level">Level 1</div>
						<img class="ui-pool-icon" src="img/inter.png"> <div class="ui-pool-info">0.1% C.I.</div> <br>
						<img class="ui-pool-icon" src="img/invest.png"> <div class="ui-pool-info">12 Investors</div> <br>
						<img class="ui-pool-icon" src="img/money.png"> <div class="ui-pool-info">1 ETH &#8594; 10 OT</div> <br>
						<div class="ui-pool-id">Oxf248320938b3y89yhd874h873fh38</div>
						</div>
				</div>
				
			</div>


			<div class="pool-nav" id="pool-nav-left"></div>
			<div class="pool-nav" id="pool-nav-right"></div>
		
		</div>	
		<?php require 'struct/footer.php'; ?>

	</body>
</html>