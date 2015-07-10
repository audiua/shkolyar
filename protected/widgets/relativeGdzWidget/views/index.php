<div class="book-list">
	<?php foreach($model as $data) :
		$path = 'img/'.$this->controller->id.'/'.$data->gdz_clas->clas->slug.'/'.$data->gdz_subject->subject->slug.'/'.$data->slug.'/book'; ?>

		<div class="small-book-block">

			<div class=""> 
				<?php echo CHtml::image(
					Yii::app()->baseUrl . '/' . $path.'/'.$data->slug.'.'.$data->img, 
					'SHKOLYAR.INFO - ГДЗ ' . $data->gdz_clas->clas->slug . ' клас ' . $data->gdz_subject->subject->title . ' ' .  $data->author, 
					array('class'=>'img-middle-book thumbnail ', 
						'title'=>'SHKOLYAR.INFO - ГДЗ ' . $data->gdz_clas->clas->slug . ' клас ' . $data->gdz_subject->subject->title . ' ' .  $data->author)); 
				?> 
			</div>
			<div class="">
				<?php echo Chtml::link('ГДЗ '. $data->gdz_clas->clas->slug . ' клас '. $data->gdz_subject->subject->title . ' ' .$data->author, array('/gdz/'.$data->gdz_clas->clas->slug.'/'.$data->gdz_subject->subject->slug.'/'.$data->slug)) ?>
				
				
				<?php 
					if( !empty($data->properties) ){
						echo '<div class="desc">'.$data->properties.'</div>';
					}
				?>

			</div>

			<!-- <div class="gdz-link">
				<?php // echo CHtml::link( 'ГДЗ', array('/gdz/'.$data->gdz_clas->clas->slug.'/'.$data->gdz_subject->subject->slug.'/'.$data->slug), array('class'=>'btn btn-primary btn-sm')); ?>
			</div> -->
							
		</div>

	<?php endforeach; ?>
</div>
