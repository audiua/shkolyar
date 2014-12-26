<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Підручники</h1>
<p class="description">
	&nbsp;&nbsp;&nbsp;&nbsp;Також ми сподіваємось полегшити вам пошук - онлайн підручників, з шкільної програми для українських середніх 
	загальноосвітніх шкіл. Ви можите легко і швидко знайти підручник, по якому Ви навчаєтесь у школі в
	розділі нашого порталу <?php echo CHtml::link('Підручники',array('/textbook')); ?> та переглядати його онлайн. У цьому розділі зібрані усі підручники 
	шкільної програми України для старших класів(5-11). Тепер більше не потрібно носити важкі паперові підручники, 
	адже тепер Вы завжди зможите переглядати їх онлайн у нас на порталі, в будь-якому місці, з 
	планшету чи телефона або компьютера.<br><br>
	
</p>
<div class="separator"></div>
<div class="info">Виберіть клас</div>
<?php $this->widget('ClasNumbWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Нови надходження</div>
