<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>

<!-- <div class="info">Всезнайка</div> -->
<h3 class="info">Всезнайка</h3>
<?php $this->widget('LastKnowallWidget'); ?>
<div class="separator"></div>

<h3 class="info">Підручники</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'textbook')); ?>
<div class="separator"></div>

<h3 class="info">ГДЗ</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'gdz')); ?>
<div class="separator"></div>

<h3 class="info">Твори</h3>
<?php $this->widget('LastWritingWidget'); ?>
<div class="separator"></div>

<h3 class="info">Художня література</h3>
<?php $this->widget('LastLibraryWidget'); ?>
<div class="separator"></div>

<div class="full-banner">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- sh полный баннер -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-9657826060070920"
	     data-ad-slot="7589407895"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>


<h1>Шкільний інформаційний портал <div class="logo-title">SHKOLYAR.INFO</div></h1>


<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'index'))); ?>
</div>

<?php $this->widget('LikeWidget', array('params'=>array('id'=>2))); ?>