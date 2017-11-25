<!--Author: Jerry Shikanga
Author URL: http://shikanga.co.ke
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?=$site_title?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/icons/icon.png'); ?>" />
<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>
<!--script for bootstrap js functions-->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!--script for bootbox alerts-->
<script src="<?php echo base_url('assets/js/bootbox.min.js'); ?>"></script>
<!-- Custom Theme files -->
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> 
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); }
</script>
<meta name="keywords" content="Hussaine Empire, Jerry Shikanga, Music, Videos, Audio, Photos, Gallery, Download, About, History" />
<!--Google Fonts-->

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo base_url('assets/js/move-top.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/easing.js');?>"></script>
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
<!-- //end-smoth-scrolling -->
</head>
<body>
<!--header start here-->

<div class="banner">
	<div class="container">
		<div class="header">
				<div class="logo">
					<h1><a href="<?php echo base_url();?>"><?=$site_header_title?></a></h1>
				</div>
				<div class="top-nav">
					<span class="menu"> <img src="<?php echo base_url('assets/images/icon.png');?>" alt=""/></span>
					<ul class="res">
					   <li><a href="<?php echo base_url();?>" class="active"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span></a></li> 
						<li><a href="<?php echo site_url('about');?>">About Band</a></li> 
						<li><a href="<?php echo site_url('videos');?>">Videos</a></li> 
						<li><a href="<?php echo site_url('gallery');?>">Gallery</a></li> 
						<li><a href="<?php echo site_url('events');?>">Events</a></li> 
						<li class="nav-line"><a href="<?php echo site_url('contact');?>">Contact</a></li> 
				   </ul>
					<!-- script-for-menu
						 <script>
						   $( "span.menu" ).click(function() {
							 $( "ul.res" ).slideToggle( 300, function() {
							 // Animation complete.
							  });
							 });
						</script>
		        <!-- /script-for-menu -->
				</div>
			  <div class="clearfix"> </div>
		 </div>
		 <div class="banner-main">
		 	<div class="bann-text">
			  	 <h3><?=$header_banner_text?></h3>
			  	 <a href="<?=$header_banner_link?>" id="header_banner_link">Click Here</a>
			</div>
		</div>
  </div>
</div> 
<!--header end here-->
<script type="text/javascript">
	$('#header_banner_link').click(function(event){
		event.preventDefault();
		bootbox.alert({
			message : "The video and audio shall be made available soon. Keep checking"
		});
});
</script>