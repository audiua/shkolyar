<?php  $path = 'img/library/'.$data->library_author->slug.'/'.$data->slug.'/book'; ?>

<div class="middle-book-block">

<div class=""> <?php echo CHtml::image(Yii::app()->baseUrl . '/' . $path.'/first.'.$data->img_ext, ' ', array('class'=>'img-middle-book thumbnail ')) ?> </div>
	<div class="">
		<div class="book-author"> <?php echo $data->library_author->author; ?></div>
		<div class="book-subject"> <?php echo $data->title; ?></div>
		<div class="desc">
			<!-- <p><?php // echo $data->description; 
			?></p> -->
		</div>

	</div>

	<div class="gdz-link">
		<?php echo CHtml::link( 'Перейти', array('/library/'.$data->library_author->slug.'/'.$data->slug), array('class'=>'btn btn-primary btn-sm')); ?>
	</div>		
</div>