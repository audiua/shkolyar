<div class="middle-article-block col-lg-4">
	<?php echo  CHtml::image($data->getThumb(250,170,'crop'),'aaa', array('title'=>'ssss', 'class'=>'thumbnail')); ?>
	<a href="/knowall/<?php echo $data->knowall_category->slug . '/'. $data->slug ?>" ><?php echo $data->title; ?></a>		
</div>