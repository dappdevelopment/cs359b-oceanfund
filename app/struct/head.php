
	<head>
		<meta charset="utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<title>OceanFund | <?php if (@isset($htmlTitle)){ echo $htmlTitle; } else{echo "__HTMLTITLEHERE__";} ?> </title>
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|PT+Sans:400,700|PT+Sans+Narrow:400,700" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/ui.css">
		
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ui.js"></script>		
		
		<?php 
			if(@isset($styles)){
				$html = "";
				foreach ($styles as $k => $v){
					$html .= "\t\t\t".'<link rel="stylesheet" type="text/css" href="'.$v.'">'."\n";
				}
				echo $html;
			}

			if(@isset($scripts)){
				$html = "";
				foreach ($scripts as $k => $v){
					$html .= "\t\t\t".'<script type="text/javascript" src="'.$v.'"></script>'."\n";
				}
				echo $html;
			}
		?>
	</head>