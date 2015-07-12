<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-top'))); ?>
<div class="clear"></div>

<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<?php // $this->widget('LikeWidget'); ?>
<div class="clear"></div>

<h1>Шкільний інформаційний портал <div class="logo-title">SHKOLYAR.INFO</div></h1>

<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'index'))); ?>
</div>

<h3 class="info">Підручники</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'textbook')); ?>
<div class="separator"></div>
<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<h3 class="info">ГДЗ</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'gdz')); ?>
<div class="separator"></div>

<h3 class="info">Твори</h3>
<?php $this->widget('LastWritingWidget'); ?>
<div class="separator"></div>

<h3 class="info">Художня література</h3>
<?php $this->widget('LastLibraryWidget'); ?>
<div class="separator"></div>

<!-- <div class="info">Всезнайка</div> -->
<h3 class="info">Всезнайка</h3>
<?php $this->widget('LastKnowallWidget'); ?>
<div class="separator"></div>

<?php // $this->widget('LikeWidget', array('params'=>array('id'=>2))); ?>