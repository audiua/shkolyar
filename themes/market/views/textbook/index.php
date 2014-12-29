<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Підручники</h1>
<p class="description">
	&nbsp;&nbsp;&nbsp;&nbsp;Ми сподіваємось, що зможимо полегшити вам пошук - онлайн підручників, з шкільної програми для українських середніх 
	загальноосвітніх шкіл. В
	даному розділі Ви легко і швидко можите знайти підручник, по якому навчаєтесь у школі та переглядати його онлайн. Тут зібрані усі підручники 
	шкільної програми України для старших класів(5-11). Нарешті, більше не потрібно носити важкі паперові підручники, 
	адже тепер Вы завжди зможите переглядати їх онлайн у нас на порталі, в будь-якому місці, з 
	планшету чи телефона або компьютера.<br><br>
	
</p>
<div class="separator"></div>
<div class="info">Виберіть клас</div>
<?php $this->widget('ClasNumbWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Нові надходження</div>
