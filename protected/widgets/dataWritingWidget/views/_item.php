<div class="middle-article-block col-lg-4">

	<?php 
	echo SeoHide::link('/writing/'.$data->clas->slug . '/'.$data->subject->slug .'/'. $data->slug, CHtml::image($data->getThumb(260,170,'crop'), 'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, array('title'=>'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, 'class'=>'thumbnail')));
	

	// echo CHtml::image($data->getThumb(260,170,'crop'), 'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, array('title'=>'SHKOLYAR.INFO - Твори ' . $data->clas->slug .' клас '.$data->subject->title . ' '. $data->title, 'class'=>'thumbnail')); 
	?>
	
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/writing/'.$data->clas->slug . '/'.$data->subject->slug .'/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php 
				if(isset($this->params['clas'])){
					echo '<span>'.$data->clas->slug.' клас</span>';
				} else {
					if(isset($this->params['subject'])){
						echo CHtml::link($data->clas->slug.' клас', '/writing/'.$data->clas->slug . '/' . $data->subject->slug ,array('class'=>'')); 
					} else {
						echo CHtml::link($data->clas->slug.' клас', '/writing/'.$data->clas->slug ,array('class'=>'')); 
					}
				}
			?>
			<?php 
				if(isset($this->params['subject'])){
					echo '<span>, '.Helper::getShort($data->subject->title).'</span>';
				} else { 
					if(isset($this->params['clas'])){
						echo '<span>, </span>'.  CHtml::link(Helper::getShort($data->subject->title), '/writing/'.$data->clas->slug . '/' .$data->subject->slug ,array('class'=>'')); 
					} else {
						echo '<span>, </span>'.  CHtml::link(Helper::getShort($data->subject->title), '/writing/'.$data->subject->slug ,array('class'=>'')); 
					}
				}
			?>
	</div>

</div>