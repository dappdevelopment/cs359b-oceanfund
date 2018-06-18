		<header class="ui-header">
			<a href="index.php"><img src="img/logo.png" class="ui-header-logo" /></a>
			<nav class="ui-header-nav"> 
				<a href="index.php" class="ui-header-menu-item <?php if(@$activeMenuItem === 1){echo 'ui-header-active-menu-item';}?>">Home</a>
				<a href="index.php" class="ui-header-menu-item <?php if(@$activeMenuItem === 2){echo 'ui-header-active-menu-item';}?>">About</a>
				<a href="index.php" class="ui-header-menu-item <?php if(@$activeMenuItem === 3){echo 'ui-header-active-menu-item';}?>">Team</a>				
			</nav>
			<a href="profile.php"><div class="ui-header-user-token">Oxf2284832</div></a>
			<a href="profile.php"><img class="ui-header-user-image" src="img/user.jpg" /></a>
			<div class="ui-header-notif"></div>
		</header>
		<header class="ui-sub-header">
			<nav class="ui-sub-header-nav">
				<a href="index.php" class="ui-sub-header-menu-item <?php if(@$activeSubMenuItem === 1){echo 'ui-sub-header-active-menu-item';}?>">Pool Management</a>
				<a href="index.php" class="ui-sub-header-menu-item <?php if(@$activeSubMenuItem === 2){echo 'ui-sub-header-active-menu-item';}?>">Investments</a>
			</nav>
			<h2 class="ui-sub-header-head"><?php if (@isset($htmlTitle)){ echo $pageTitle; } else{echo "__PAGETITLEHERE__";} ?></h2>
		</header>