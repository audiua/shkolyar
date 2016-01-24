<?php 
$categoryClas = $this->controller->id . '_clas';
$path = 'img/'.$this->controller->id.'/'.$this->params['clas'].'/'.$this->params['subject'].'/'.$this->model->slug.'/book';
$controller = ($this->controller->id=='gdz') ? 'ГДЗ ':'Підручник ';
?>

<div class="">
<?php echo CHtml::image($this->model->getThumb(140,200,'resize')); 


?> 
</div>
	<div class="">
		<div class="book-author"><span class="gray small">автор: </span><?php echo $this->model->author; ?></div>
		<div class="book-subject"><span class="gray small">предмет: </span>
		<?php 
			$subj = $this->model->textbook_subject->name;
			$subj .= $this->model->properties ? ' ' . $this->model->properties : '' ;
			echo  $subj;
		?></div>
		<div class="book-clas"><span class="gray small">клас: </span><?php echo $this->model->$categoryClas->clas->slug; ?> клас</div>
	
		<?php if($this->model->year): ?>
		<div class="book-clas"><span class="gray small">рік: </span><?php echo $this->model->year; ?></div>
		<?php endif; ?>

		<?php if($this->model->edition): ?>
		<div class="book-clas"><span class="gray small">видавництво: </span><?php echo $this->model->edition; ?></div>
		<?php endif; ?>

		
		
		<div class="social-likes">
			<div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div>
			<div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div>
			<div class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</div>
			<div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div>
		</div>


		<div class="clear"></div>
		

	</div>
<div class="textbook-link">
	<?php 
	// $controller = $this->controller->id=='gdz' ? 'textbook' : 'gdz';
	// echo $controller;
	// die;
	// if($this->controller->checkerBook($this->model->slug, $this->params['clas'], $this->params['subject'])){
	// 	echo CHtml::link( $this->controller->id=='gdz'? 'Підручник' : 'ГДЗ' , array('/'.$controller.'/'.$this->params['clas'].'/'.$this->params['subject'].'/'.$this->model->slug)); 
	// }
	?>
</div>
