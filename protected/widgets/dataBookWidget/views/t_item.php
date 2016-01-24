<?php 
$categoryClas = $this->controller->id . '_clas';
$categorySubject = $this->controller->id . '_subject';
if($this->controller->id == 'gdz'){
$subject = $data->$categorySubject->title;
	
} else {
	$subject = $data->$categorySubject->name;
}

$path = 'img/'.$this->controller->id.'/'.$data->$categoryClas->slug.'/'.$data->$categorySubject->slug.'/'.$data->slug.'/book'; ?>

<div class="middle-book-block">

	<div class=""> <?php 
		$contr = ($this->controller->id=='gdz') ? 'ГДЗ ':'Підручник ';
		echo SeoHide::link('/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->slug.'/'.$data->slug, CHtml::image($data->getThumb(140,200,'resize')));
		?>
	</div>

	<div class=" desc">
		<?php echo CHtml::link( $contr. str_replace('-clas', '', $data->$categoryClas->clas->slug) . ' клас '. $subject . ' ' .$data->author, array('/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->slug.'/'.$data->slug)); ?>

		<?php 
			// if( !empty($data->properties) ){
			// 	echo '<div class="desc">'.$data->properties.'</div>';
			// }
		?>
	</div>
					
</div>