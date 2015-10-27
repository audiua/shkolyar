<div class="book-list">
	<?php foreach($model as $data) :
	$path = 'img/library/'.$data->library_author->slug.'/'.$data->slug.'/book'; ?>

	<div class="small-book-block">

	<div class=""> 
	<?php echo SeoHide::link('/library/'.$data->library_author->slug.'/'.$data->slug, CHtml::image(Yii::app()->baseUrl . '/' . $path.'/first.'.$data->img_ext, $data->library_author->author . ' ’’'.$data->title.'’’', array('class'=>'img-middle-book thumbnail ')));

	// echo CHtml::image(Yii::app()->baseUrl . '/' . $path.'/first.'.$data->img_ext, 'SHKOLYAR.INFO - Художня література ' . $data->library_author->author . ' ’’'.$data->title.'’’', array('class'=>'img-middle-book thumbnail ', 'title'=>'SHKOLYAR.INFO - Художня література ' . $data->library_author->author . ' ’’'.$data->title.'’’')) 
	?> 
	</div>
		<div class="">
			<?php echo CHtml::link($data->library_author->author.' - '.$data->title, 
			array('/library/'.$data->library_author->slug.'/'.$data->slug), array('class'=>'info'));?>
		</div>	
	</div>

	<?php endforeach; ?>
</div>




