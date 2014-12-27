<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<div class="info">Твори</div> 
<p class="description">
&nbsp;&nbsp;&nbsp;&nbsp;У цьому розділі Ви знайдети шкільні твори, сгруповані по класам та предметам для зручнішого пошуку. Вони представлені для того, щоб послугувати Вам прикладом, навіяти ідею чи ще якось допомогти у написані творів. Усі твори максимально розкривають тему і є змістовно правильними, але команда порталу <strong>SHKOLYAR.INFO</strong> не несе відповідальність за отримані оцінки при повному копіруванні данних творів, вони представленні виключно в ознайомлюванних ціллях.<br><br>
</p>


<div class="separator"></div>
<div class="info">Виберіть клас</div>

<?php $this->widget('WritingClasWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>






<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>