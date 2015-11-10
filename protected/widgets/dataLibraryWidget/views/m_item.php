<?php  $path = 'img/library/'.$data->library_author->slug.'/'.$data->slug.'/book'; ?>

<div class="middle-book-block">

	<?php echo CHtml::link($data->title, 
		array('/library/'.$data->library_author->slug.'/'.$data->slug), array('class'=>'book-subject'));?>



		
</div>