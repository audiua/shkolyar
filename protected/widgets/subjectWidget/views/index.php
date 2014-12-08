<div class="subject-list">
	<?php 
		$class = 5;
	$field= $this->controller->id.'_book';
	foreach( $this->model as $i => $one ): 
	    if( $one->$field ): ?>
			<div class="subject">
			    <h3><?php 
			    	// выводим только с книгами
				    	echo CHtml::link( $one->subject->title, array('/'.$this->controller->id.'/'.$this->params['clas'].'/'.$one->subject->slug), array('class'=>'clas-'.$class, 'title'=>'ГДЗ '.$this->params['clas'] . ' клас '. $one->subject->title)); 
		    	?></h3>
			</div>
	<?php endif;
	$class++;
	$class = $class == 12 ? 5 : $class ;
	endforeach; ?>
</div>





