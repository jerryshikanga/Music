<div class="container">
	<div class="about-left">
		<h2>VIDEOS</h2>s
			<?php foreach ($videos as $video) : ?>
			<div class="about-bottom">
				<div class="col-md-3 about-grid">
					<h6><?=$video->name?></a></h6>
					<p><?=$video->description?></p>
				</div>
					<div class="col-md-7 about-grid1">
						<iframe width="420" height="315" src="<?=$video->url?>">
						</iframe>								
					</div>
				<div class="clearfix"> </div>
			</div>
			<?php endforeach;?>
	</div>
</div>