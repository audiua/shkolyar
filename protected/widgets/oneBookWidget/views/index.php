<?php 
$categoryClas = $this->controller->id . '_clas';
$path = 'images/'.$this->controller->id.'/'.$this->params['clas'].'/'.$this->params['subject'].'/'.$this->model->slug.'/book';?>

<div class="">
<?php echo CHtml::image(Yii::app()->baseUrl . '/' . $path.'/'.$this->model->slug.'.'.$this->model->img, $this->controller->id=='gdz'? 'Підручник' : 'ГДЗ' . $this->model->$categoryClas->clas->slug .' клас '. $this->model->title . ' ' . $this->model->author, 
	array('class'=>'img-middle-book thumbnail')); 
?> 
</div>
	<div class="">
		<div class="book-author"><?php echo $this->model->author; ?></div>
		<div class="book-subject"><?php echo $this->model->title; ?></div>
		<div class="book-clas"><?php echo $this->model->$categoryClas->clas->slug; ?> клас</div>
		<div class="desc">
			<p><?php echo $this->model->description; ?></p>
		</div>

	</div>
<div class="textbook-link">
	<?php 
	$controller = $this->controller->id=='gdz' ? 'textbook' : 'gdz';
	// echo $controller;
	// die;
	// if($this->controller->checkerBook($this->model->slug, $this->params['clas'], $this->params['subject'])){
	// 	echo CHtml::link( $this->controller->id=='gdz'? 'Підручник' : 'ГДЗ' , array('/'.$controller.'/'.$this->params['clas'].'/'.$this->params['subject'].'/'.$this->model->slug)); 
	// }
	?>
</div>
