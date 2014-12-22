<div class="middle-article-block">
	<a href="/knowall/<?php echo $data->knowall_category->slug . '/'. $data->slug ?>" ><?php echo $data->title; ?></a>
	<div class="article-description">
		<?php echo $data->description; ?>
	</div>			
</div>

<?php print_r($data->knowall_category->slug); ?>