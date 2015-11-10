<h1><?php echo  $model->title; ?> </h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="article">
	
<?php echo  $model->text; ?>

</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="info">Схожі твори для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeWritingWidget.RelativeWritingWidget');
	$this->widget('RelativeWritingWidget', array('article'=>$model)); ?>
</div>
