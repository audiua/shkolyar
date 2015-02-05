<div class="article-list">
	<?php foreach( $model as $data ): ?>

	<div class="middle-article-block col-lg-4">

	<?php echo CHtml::image($data->getThumb(260,170,'crop'), 'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, array('title'=>'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, 'class'=>'thumbnail')); ?>
	
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/writing/'.$data->clas->slug . '/'.$data->subject->slug .'/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">

			<?php 

				echo CHtml::link($data->clas->slug.' клас', '/writing/'.$data->clas->slug . '/' . $data->subject->slug ,array('class'=>'')); 
				echo '<span>, </span>'.  CHtml::link(Helper::getShort($data->subject->title), '/writing/'.$data->subject->slug ,array('class'=>'')); 
			?>
			
	</div>

	</div>

<?php endforeach; ?>


</div>