<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<div class="info">Всезнайка</div>
<?php $this->widget('LastKnowallWidget'); ?>
<div class="separator"></div>

<div class="info">Підручники</div>
<?php $this->widget('LastBookWidget', array('mode'=>'textbook')); ?>
<div class="separator"></div>

<div class="info">ГДЗ</div>
<?php $this->widget('LastBookWidget', array('mode'=>'gdz')); ?>
<div class="separator"></div>

<h1>Шкільний інформаційний портал <div class="logo-title">SHKOLYAR.INFO</div></h1>


<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'index'))); ?>
</div>