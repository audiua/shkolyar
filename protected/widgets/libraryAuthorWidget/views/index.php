<div class="library-author-list">
	<?php foreach( $this->model as $i => $one ): ?>
			<div class="library-author">
			    <h3><?php 
			    	// выводим только с книгами
				    	echo CHtml::link( $one->author, array('/library/'.$one->slug), array('class'=>'', 'title'=>'')); 
		    	?></h3>
			</div>
	<?php endforeach; ?>
</div>





