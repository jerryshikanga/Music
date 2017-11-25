<div class="singer">
	<div class="container">
		<div class="singer-main">
			  <div class="col-md-4 singer-left">
			  	<a href="#"><img src="<?php echo base_url('assets/images/pic1.jpg');?>" width="300px" height="300px"></a>
			  </div>
			  <div class="col-md-8 singer-right">
			  	<h3>Prince Kayne</h3>
			  	<h4>Duis aute irure dolor in reprehenderit</h4>
			  	<h5>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h5>
			  	<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</p>
			  </div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--info end here-->
<div class="singer">
	<div class="container">
		<div class="singer-main">
			  <div class="col-md-8 singer-right">
			  	<h3>Do you believe you have what it takes?</h3>
			  	<h4>We are looking for models</h4>
			  	<p>The Hussaine Empire is asking all young and beautiful girls to audition for the Models Positions. They will be in house models and will be offered a wide array of opportunities in and out of the music industry.</p>
			  </div>
			  <div class="col-md-4 singer-left">
			  	<a href="#"><img width="75%" height="75%" src="<?php echo base_url('assets/images/model1.jpg');?>" alt="Model Picture" class="img-rounded"/></a>
			  </div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--program end here-->
<!--music strip-->
<div class="music-strip">
	<div class="container">
		<div class="music-strip-main">
		   <div class="col-md-9 music-strip-left">
				<h3> Nam libero tempore cum soluta nobis</h3>
				<h4> Itaque earum rerum hic tenetur a sapiente delectus ut aut reiciendis</h4>
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique</p>
		   </div>
		   <div class="col-md-3 music-strip-right">
		   	     <a href="<?php echo base_url('single');?>">Read More</a>
		   </div>
	   </div>
	</div>
</div>
<!--music strip end here-->
<!--feature start here-->
<div class="feature">
	<div class="container">
		<div class="features-main">
			<h3>Featured Events</h3>
			 <div class="fea-grid-bottom">
			 	<?php $counter = 1; ?>
			 	<?php foreach ($events as $eventItem) : ?>
			 		<?php $eventItem->image = base_url($eventItem->image);?>
			 		<div class="row feature-row">
			 			<h4 class="text-center title-text-bold-green"><?=$eventItem->title?> , <?php echo format_date($eventItem->date_happening)?></h4>
			 			<div class="col-md-6">
			 				<img src="<?=$eventItem->image?>" alt="" class="img-responsive">
			 			</div>
			 		
			 			<div class="col-md-6 fea-grid">
				 			<div class="row">
				 				<h5><?=$eventItem->location?></h5>
				 			</div>
				 			<p><?=$eventItem->description?></p>
				 			<a href="<?php echo base_url('#');?>">Read More</a>
				 			<?php if ($counter==3) { break; } $counter++; ?>
			 			</div>
			 		</div>
			 	<?php endforeach; ?>
			 	<div class="clearfix"> </div>
			 </div>
		</div>
	</div>
</div>
<!--feature end here