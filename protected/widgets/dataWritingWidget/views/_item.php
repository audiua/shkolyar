<div class="middle-article-block col-lg-4">

	<?php echo CHtml::image($data->getThumb(260,170,'crop'),$data->title, array('title'=>$data->title, 'class'=>'thumbnail')); ?>
	
	
	<div class="knowall-link">
		<?php echo CHtml::link($data->title,'/writing/'.$data->clas->slug . '/'.$data->subject->slug .'/'. $data->slug ,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php 
				if(isset($this->params['clas'])){
					echo '<span>'.$data->clas->slug.' клас</span>';
				} else {
					echo CHtml::link($data->clas->slug.' клас', '/writing/'.$data->clas->slug ,array('class'=>'')); 
				}
			?>
			<?php 
				if(isset($this->params['subject'])){
					echo '<span>, '.Helper::getShort($data->subject->title).'</span>';
				} else { 
					echo '<span>, </span>'.  CHtml::link(Helper::getShort($data->subject->title), '/writing/'.$data->subject->slug ,array('class'=>'')); 
				}
			?>
	</div>

</div>