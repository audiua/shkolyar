<?php 

$path = 'img/library/'.$this->model->library_author->slug . '/' . $this->model->slug .'/book';?>

<div class="">
<?php echo CHtml::image(Yii::app()->baseUrl . $path . '/first' . '.' . $this->model->img_ext, '', 
	array('class'=>'img-middle-book thumbnail one-book')); 
?> 
</div>
<div class="">
	<div class="description">
		<p><?php echo $this->model->description; ?></p>
	</div>

</div>
