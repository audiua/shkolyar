<div class="middle-article-block col-lg-4">

	<?php echo CHtml::image($data->getThumb(260,170,'crop'),$data->title, array('title'=>$data->title, 'class'=>'thumbnail')); ?>
	
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/writing/'.$data->clas->slug . '/'.$data->subject->slug .'/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php echo CHtml::link($data->clas->slug, '/writing/'.$data->clas->slug ,array('class'=>'')); ?> <?php echo CHtml::link(Helper::getShort($data->subject->title), '/writing/'.$data->clas->slug ,array('class'=>'')); ?>
	</div>

</div>