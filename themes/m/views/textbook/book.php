<h1><?php echo $this->h1; ?></h1>

<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('OneBookWidget', array('model'=>$this->bookModel)); ?>	
	</div>
	
</div>

<div class="clear"></div>
<div class="separator task-separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_m_above_task'))); ?>

<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі підручники для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeTextbookWidget.RelativeTextbookWidget');
	$this->widget('RelativeTextbookWidget'); ?>
</div>