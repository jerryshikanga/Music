<!--news start here-->
<div class="news">
	<div class="container">
		<div class="news-main">
			<div class="news-head">
				<h3>Events</h3>
				<p>We have the following upcoming events. Please check them out</p>
			</div>

			<?php foreach ($events as $eventItem) :?>
				<?php $eventItem->image = base_url($eventItem->image);?>
				<div class="news-top">
					<h4> <?=$eventItem->location?> , <?php echo format_date($eventItem->date_happening)?> </h4>
					<div class="col-md-6  news-left">
						<a href="<?php echo $eventItem->image;?>"><img src="<?=$eventItem->image?>" alt="" class="img-responsive"></a>
					</div>
					<div class="col-md-6  news-right">
						<h4><?=$eventItem->title?></h4>
						<p><?=$eventItem->description?></p>
					</div>
					<div class="clearfix"> </div>
				</div>
			<?php endforeach; ?>


		</div>
	</div>
</div>
<!--news end here-->