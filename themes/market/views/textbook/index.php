<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-top'))); ?>
<div class="clear"></div>


<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
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


<div class="info">Виберіть клас</div>
<?php $this->widget('ClasNumbWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>
<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<div class="info">Нові надходження</div>

<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>


