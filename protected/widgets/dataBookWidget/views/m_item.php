<?php 
$categoryClas = $this->controller->id . '_clas';
$categorySubject = $this->controller->id . '_subject';

$path = 'img/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug.'/book'; ?>

<div class="item col-lg-3 col-md-4 col-sm-4 col-xs-12">

	<div class=""> <?php 
		$contr = ($this->controller->id=='gdz') ? 'ГДЗ ':'Підручник ';
		echo SeoHide::link('/'.$this->controller->id.'/'.$data->$categoryClas->clas->slug.'/'.$data->$categorySubject->subject->slug.'/'.$data->slug, CHtml::image($data->getThumb(140,200,'resize')));
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