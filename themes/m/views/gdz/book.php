<h1><?php echo $this->h1; ?></h1>


<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
	<?php $this->widget('OneBookWidget', array('model'=>$this->bookModel)); ?>
	</div>
	
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="task">
	<div class="loading"></div>
	<div class="darking"></div>
</div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="info">Виберіть <?php echo  $this->bookModel->pagination == 'page' ? 'сторінку' : 'завдання' ; ?></div>
<div class="task-block">
	<?php $this->widget('TaskWidget'); ?>
</div>

<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі збірники гдз для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeGdzWidget.RelativeGdzWidget');
	$this->widget('RelativeGdzWidget'); ?>
</div>