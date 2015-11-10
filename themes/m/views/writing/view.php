<h1><?php echo  $model->title; ?> </h1>

<div class="article">
	
<?php echo  $model->text; ?>
<?php $this->renderDynamic('getUpdateBtn', array('id'=>$model->id)); ?>
</div>




<div class="clear"></div>
<div class="separator"></div>

<div class="info">Схожі твори для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeWritingWidget.RelativeWritingWidget');
	$this->widget('RelativeWritingWidget', array('article'=>$model)); ?>
</div>
