<h1><?php echo  $model->title ; ?> </h1> 

<div class="info"><?php echo  $model->library_author->author ; ?></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('LibraryBookWidget', array('model'=>$model)); ?>	
	</div>
</div>

<div class="clear"></div>
<div class="separator task-separator"></div>

<div class="task"></div>

<div class="info">Виберіть сторінку</div>
<div class="task-block">
	<?php $this->widget('LibraryTaskWidget'); ?>
</div>


<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі твори художньої літератури:</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeLibraryWidget.RelativeLibraryWidget');
	$this->widget('RelativeLibraryWidget', array('book'=>$model)); ?>
</div>