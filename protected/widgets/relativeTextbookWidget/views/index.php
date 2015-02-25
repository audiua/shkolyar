<div class="book-list">
	<?php foreach($model as $data) :
		$path = 'img/'.$this->controller->id.'/'.$data->textbook_clas->clas->slug.'/'.$data->textbook_subject->subject->slug.'/'.$data->slug.'/book'; ?>

		<div class="small-book-block">

			<div class=""> 
				<?php echo CHtml::image(
					Yii::app()->baseUrl . '/' . $path.'/'.$data->slug.'.'.$data->img, 
					'SHKOLYAR.INFO - ГДЗ ' . $data->textbook_clas->clas->slug . ' клас ' . $data->textbook_subject->subject->title . ' ' .  $data->author, 
					array('class'=>'img-middle-book thumbnail ', 
						'title'=>'SHKOLYAR.INFO - ГДЗ ' . $data->textbook_clas->clas->slug . ' клас ' . $data->textbook_subject->subject->title . ' ' .  $data->author)); 
				?> 
			</div>
			<div class="">
				<div class="book-author"> <?php echo $data->author; ?></div>
				<div class="book-subject"> <?php echo $data->title; ?></div>
				<div class="book-clas"><?php echo $data->textbook_clas->clas->slug; ?> клас</div>
				<?php 
					if( !empty($data->properties) ){
						echo '<div class="desc">'.$data->properties.'</div>';
					}
				?>

			</div>

			<div class="textbook-link">
				<?php echo CHtml::link( 'Підручник', array('/textbook/'.$data->textbook_clas->clas->slug.'/'.$data->textbook_subject->subject->slug.'/'.$data->slug), array('class'=>'btn btn-warning btn-xs')); ?>
			</div>
								
		</div>

	<?php endforeach; ?>
</div>
