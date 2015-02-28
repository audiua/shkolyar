<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Підручники</h1>


<div class="description">
	<p>
		Ми сподіваємось, що зможемо полегшити Вам пошук онлайн підручників з шкільної програми для українських середніх 
		загальноосвітніх шкіл. В
		даному розділі Ви легко і швидко можете знайти підручник, згідно якого навчаєтесь у школі, та переглядати його онлайн. Тут зібрані усі підручники 
		шкільної програми України для старших класів (5-11). Нарешті більше не потрібно носити важкі паперові підручники, 
		адже тепер Ви завжди зможете переглядати їх онлайн у нас на порталі, в будь-якому місці, з 
		планшету чи телефона або комп’ютера.
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
<?php $this->widget('ClasNumbWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Нові надходження</div>

<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>


