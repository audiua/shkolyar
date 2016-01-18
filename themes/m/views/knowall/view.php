<h1><?php echo  $model->title; ?> </h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="article">
	
<?php echo  $model->text; ?>
	
</div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_m_above_task'))); ?>

<div class="info">Схожі статті</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeKnowallWidget.RelativeKnowallWidget');
	$this->widget('RelativeKnowallWidget', array('article'=>$model)); ?>
</div>