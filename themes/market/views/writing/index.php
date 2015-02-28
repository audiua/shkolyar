<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo $this->h1; ?></h1>

<div class="description">
<p>
	У цьому розділі Ви знайдете шкільні твори, згруповані по класам та предметам для зручнішого пошуку. Вони представлені для того, щоб послугувати Вам прикладом, навіяти ідею чи ще якось допомогти у написанні творів. Усі твори максимально розкривають тему і є змістовно правильними, але команда порталу <span class="shkolyar" >SHKOLYAR.INFO</span> не несе відповідальності за отримані оцінки при повному копіюванні даних творів, вони представлені виключно в ознайомлюваних цілях.
</p>
</div>
<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>
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


<div class="info">Виберіть клас</div>

<?php $this->widget('WritingClasWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>
<div class="info">Виберіть твір</div>

<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>