<div class="middle-article-block col-lg-4">

	
	<?php echo CHtml::link(CHtml::image($data->getThumb(260,170,'crop'),$data->title, array('title'=>$data->title, 'class'=>'thumbnail')),'/knowall/'.$data->knowall_category->slug . '/'. $data->slug ,array('class'=>'', 'rel'=>'noffolow')); ?>
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/knowall/'.$data->knowall_category->slug . '/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<?php 

		if( isset($this->params['linkCategory']) && $this->params['linkCategory'] ):

	 ?>

	<div class="knowall-category-link">
			<?php echo CHtml::link($data->knowall_category->title, '/knowall/'.$data->knowall_category->slug ,array('class'=>'')); ?>
	</div>

	<?php 
		else :?>
	<div class="knowall-category-link">
		<span><?php echo $data->knowall_category->title; ?></span>
	</div>

<?php endif; ?>

</div>