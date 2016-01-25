<div class="book-list">
	<?php foreach($model as $data) :
	$clas = str_replace('-clas', '', $data->textbook_clas->clas->slug);
		// $path = 'img/'.$this->controller->id.'/'.$data->textbook_clas->clas->slug.'/'.$data->textbook_subject->subject->slug.'/'.$data->slug.'/book'; ?>

		<div class="small-book-block">

			<div class=""> 
				<?php 
				echo SeoHide::link('/textbook/'.$clas.'-clas/'.$data->textbook_subject->slug.'/'.$data->slug, CHtml::image($data->getThumb(140,200,'resize')));

				// echo CHtml::image(
				// 	Yii::app()->baseUrl . '/' . $path.'/'.$data->slug.'.'.$data->img, 
				// 	'SHKOLYAR.INFO - ГДЗ ' . $clas . ' клас ' . $data->textbook_subject->subject->title . ' ' .  $data->author, 
				// 	array('class'=>'img-middle-book thumbnail ')); 
				?> 
			</div>
			<div class="">
				<div class="book-author"> <?php echo $data->author; ?></div>
				<div class="book-subject"> <?php echo $data->textbook_subject->name; ?></div>
				<div class="book-clas"><?php echo $clas; ?> клас</div>
				<?php 
					if( !empty($data->properties) ){
						echo '<div class="desc">'.$data->properties.'</div>';
					}
				?>

			</div>

			<div class="textbook-link">
				<?php echo CHtml::link( 'Підручник', array('/textbook/'.$clas.'-clas/'.$data->textbook_subject->slug.'/'.$data->slug), array('class'=>'btn btn-warning btn-xs')); ?>
			</div>
								
		</div>

	<?php endforeach; ?>
</div>
