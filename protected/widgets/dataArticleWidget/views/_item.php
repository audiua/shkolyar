<div class="middle-article-block col-lg-4">

	<?php echo CHtml::image($data->getThumb(260,170,'crop'),$data->title, array('title'=>$data->title, 'class'=>'thumbnail')); ?>
	
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/knowall/'.$data->knowall_category->slug . '/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php echo CHtml::link($data->knowall_category->title, '/knowall/'.$data->knowall_category->slug ,array('class'=>'')); ?>
	</div>

</div>