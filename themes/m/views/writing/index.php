<h1><?php echo $this->h1; ?></h1>

<div class="description">
<p>
	У цьому розділі Ви знайдете шкільні твори, згруповані по класам та предметам для зручнішого пошуку. Вони представлені для того, щоб послугувати Вам прикладом, навіяти ідею чи ще якось допомогти у написанні творів. Усі твори максимально розкривають тему і є змістовно правильними, але команда порталу <span class="shkolyar" >SHKOLYAR.INFO</span> не несе відповідальності за отримані оцінки при повному копіюванні даних творів, вони представлені виключно в ознайомлюваних цілях.
</p>
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть клас</div>

<?php $this->widget('WritingClasWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть твір</div>

<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>