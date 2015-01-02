<?php 
$categoryClas = $this->controller->id . '_clas';
$categorySubject = $this->controller->id . '_subject';

$path = 'img/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug.'/book'; ?>

<div class="middle-book-block">

<div class=""> <?php echo CHtml::image(Yii::app()->baseUrl . '/' . $path.'/'.$data->slug.'.'.$data->img, $data->author . ' '.$data->description, array('class'=>'img-middle-book thumbnail ')) ?> </div>
	<div class="">
		<div class="book-author"> <?php echo $data->author; ?></div>
		<div class="book-subject"> <?php echo $data->title; ?></div>
		<div class="book-clas"><?php echo $data->$categoryClas->clas->slug; ?> клас</div>
		<?php 
			if( !empty($data->properties) ){
				echo '<div class="desc">'.$data->properties.'</div>';
			}
		?>

	</div>

	<div class="gdz-link">
		<?php echo CHtml::link( 'Перейти до ГДЗ', array('/gdz/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug), array('class'=>'btn btn-primary btn-sm')); ?>
	</div>
	<div class="textbook-link">
		<?php echo CHtml::link( 'Перейти до підручника', array('/textbook/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug), array('class'=>'btn btn-warning btn-sm')); ?>
	</div>
					
</div>