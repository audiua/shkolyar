<?php 
$categoryClas = $this->controller->id . '_clas';
$categorySubject = $this->controller->id . '_subject';

$path = 'img/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug.'/book'; ?>

<div class="middle-book-block">

	<div class=""> <?php 
		$contr = ($this->controller->id=='gdz') ? 'ГДЗ ':'Підручник ';
		echo SeoHide::link('/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug, CHtml::image(Yii::app()->baseUrl . '/' . $path.'/'.$data->slug.'.'.$data->img, $contr . $data->$categoryClas->clas->slug . ' клас ' . $data->$categorySubject->subject->title . ' ' .  $data->author, array('class'=>'img-middle-book thumbnail ')));
		?>
	</div>

	<div class=" desc">
		<?php echo CHtml::link( $contr. $data->$categoryClas->clas->slug . ' клас '. $data->$categorySubject->subject->title . ' ' .$data->author, array('/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug)); ?>

		<?php 
			// if( !empty($data->properties) ){
			// 	echo '<div class="desc">'.$data->properties.'</div>';
			// }
		?>
	</div>
					
</div>