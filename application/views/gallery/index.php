<!--banner start here-->
<div class="bann-two">

</div>
<!--banner end here-->
<!--gallery start here-->
<div class="gallery">
	<div class="container">
		<div class="gallery-main">
			<div class="gallery-top">
			    <h3>Gallery</h3>
			    <p>We in patnership with DedPixel Arts have a collection of profesional photos. Take a look at some of them below!!</p>
			</div>
			<div class="gallery-bottom">
				<div class="gallery-1">
					<?php foreach ($galleryImages as $image) : ?>
						<?php $image->src = base_url($image->src);?>
						<div class="col-md-4 gallery-left">
							<a href="<?=$image->src?>" rel="title" class="mask">
								<img src="<?=$image->src?>" alt="<?=$image->name?>" class="img-responsive zoom-img">
							</a>
						</div>
					<?php endforeach; ?>
					<div class="clearfix"> </div>
				</div>
			</div>

		 </div>
	</div>
</div>
<!--gallery  end here-->
<!--light-box-files -->
		<script src="<?php echo base_url('assets/js/jquery.chocolat.js');?>"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/chocolat.css')?>" type="text/css" media="screen" charset="utf-8">
		<!--light-box-files -->
		<script type="text/javascript" charset="utf-8">
		$(function() {
			$('.gallery-bottom a').Chocolat();
		});
		</script>