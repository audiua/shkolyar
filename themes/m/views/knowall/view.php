<h1><?php echo  $model->title; ?> </h1>

<div class="article">
	
<?php echo  $model->text; ?>
	
</div>


<div class="clear"></div>
<div class="separator"></div>


<div class="info">Схожі статті</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeKnowallWidget.RelativeKnowallWidget');
	$this->widget('RelativeKnowallWidget', array('article'=>$model)); ?>
</div>