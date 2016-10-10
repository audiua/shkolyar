<div class="book-list">
	<?php foreach($model as $data) :
	$path = 'img/library/'.$data->library_author->slug.'/'.$data->slug.'/book'; ?>

	<div class="small-book-block">

		<div class="">
			<?php echo CHtml::link($data->library_author->author.' - '.$data->title, 
			array('/library/'.$data->library_author->slug.'/'.$data->slug), array('class'=>'info'));?>
		</div>	

	</div>
	<?php endforeach; ?>
</div>




