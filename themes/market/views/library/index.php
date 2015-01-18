<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Художня література</h1> 
<p class="description">
&nbsp;&nbsp;&nbsp;&nbsp;Тут зібрані усі твори з української 
та зарубіжної літератури, які вивчаються по шкільній програмі у старших класах(5-11). Ви можите знайти і читати їх онлайн у цьому розділі, що значно зручніше та легше ніж шукати потрібні твори по бібліотекам, а потім забувати їх здавати і через декілька років намагатися переконати бібліотекаря, що Ви їх ніколи не брали, що це якась помилка :). Ну звісно, у Вас так не буває. Усі твори згрупованні по їх авторам, що значно полегшує пошук - Ви просто вибираєте потрібного автора, а потім вибираєте потрібний твір цього автора. <br><br>
</p>
<div class="clear"></div>
<div class="separator"></div>
<div class="info">Виберіть автора</div> 
<?php $this->widget('LibraryAuthorWidget', array('model'=>$authors)); ?>