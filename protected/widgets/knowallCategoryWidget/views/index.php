<div class="subject-list">
	<?php 
		$class = 5;
	foreach( $this->model as $i => $one ): 
		if($one->knowall):
		?>
			<div class="subject">
			    <h3><?php 
			    	// выводим только с книгами
				    	echo CHtml::link( $one->title, array('/'.$this->controller->id.'/'.$one->slug), array('class'=>'clas-'.$class, 'title'=>'')); 
		    	?></h3>
			</div>
	<?php 
	endif;
	$class++;
	$class = $class == 12 ? 5 : $class ;
	endforeach; ?>
</div>





