<?php 
$content=$layoutVars['content'];
$title=$layoutVars['title'];
?>
<!DOCTYPE html PUBLIC 
	"-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Full Moon Template</title>    
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/main.css" rel="stylesheet" type="text/css"/>
	
	<script type='text/javascript' src='/assets/Scripts/jquery-1.3.2.min.js'></script>
	
	<!-- Tooltip -->
	<script type="text/javascript" src="/assets/Scripts/jquery.tipsy.js"></script>
	
	<!-- fade in/fade out -->
	<script type="text/javascript" src="/assets/Scripts/jquery.innerfade.js"></script>
	
	<!-- Featured list -->
	<script type="text/javascript" src="/assets/Scripts/jquery.featureList-1.0.0.js"></script>
</head>
<body>
<?php require '/assets/js/script_home.js';?>
<div id="wrapper">	
	<div id="top">
		<?php require 'partials/top.php';?>    
	</div>
	<div>
		<?php require 'partials/nav.php';?>    
	</div>	  
	<div class="hr"></div>	  
	<div id="preview_wrap">
		<?php require 'partials/preview.php';?>
	</div>
	<div id="thumbs">
		<?php require 'partials/thumbs.php';?>		
	</div>	      
	<div id="contentWrap">
		<div class="hr_line"></div>
		<div id="content-two-third">
			<?php //require 'partials/content.php';?>
			<h1><?=$title;?></h1>
			<?=$content;?>	
		</div>
		<div id="column" class="right">      
			<?php require 'partials/right.php';?>
		</div>
	</div>
	<div id="footer">
		<?php require 'partials/footer.php';?>    
	</div>
	<div id="social">   	
		<?php require 'partials/socials.php';?>
	</div>
</div>

<div class="bottom"></div>

<!-- twitter -->
<?php require 'partials/twitter.php';?>

</body>
</html>