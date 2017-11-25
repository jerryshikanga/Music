<!--footer start here-->
<div class="footer">
	<div class="container">
		<div class="footer-bottom">
			     <span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span>
			     <ul class="ftr-nav">
					   <li><a href="<?php echo site_url('');?>" class="active"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span></a></li> 
						<li><a href="<?php echo site_url('about');?>">About</a></li> 
						<li><a href="<?php echo site_url('videos');?>">Videos</a></li> 
						<li><a href="<?php echo site_url('gallery');?>">Gallery</a></li> 
						<li><a href="<?php echo site_url('events');?>">Events</a></li> 
						<li><a href="<?php echo site_url('contact');?>">Contact</a></li> 
				   </ul>
		<div class="copy-right">
			<p>&copy 2017-<?php echo date("Y");?> Hussaine Empire All rights reserved | Design by  <a href="http://shikanga.com/" target="_blank">  Jerry Shikanga </a></p>
			<ul class="social">
						<li><a href="#"><i> </i></a></li>						
						<li><a href="#"><i class="rss"> </i></a></li>
						<li><a href="#"><i class="twitter"> </i></a></li>
						<li><a href="#"><i class="dribble"> </i></a></li>
						<li><a href="#"><i class="linked"> </i></a></li>
						<li><a href="#"><i class="camera"> </i></a></li>
					</ul>
		</div>
		<script type="text/javascript">
										$(document).ready(function() {
											/*
											var defaults = {
									  			containerID: 'toTop', // fading element id
												containerHoverID: 'toTopHover', // fading element hover id
												scrollSpeed: 1200,
												easingType: 'linear' 
									 		};
											*/
											
											$().UItoTop({ easingType: 'easeOutQuart' });
											
										});
									</script>
						<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        </div>
  </div>
</div>
<!--footer end here-->
</body>
</html>