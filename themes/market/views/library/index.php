<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-top'))); ?>
<div class="clear"></div>

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
	Тут зібрані усі твори з української 
	та зарубіжної літератури, які вивчаються по шкільній програмі у старших класах (5-11). Ви можете знайти і читати їх онлайн у цьому розділі, що значно зручніше та легше ніж шукати потрібні твори по бібліотекам, а потім забувати їх здавати і через декілька років намагатися переконати бібліотекаря, що Ви їх ніколи не брали, що це якась помилка :). Ну звісно, у Вас так не буває. Усі твори згруповані по їх авторам, що значно полегшує пошук - Ви просто вибираєте потрібного автора, а потім необхідний твір.
</p>
</div>
<?php $this->widget('LikeWidget'); ?>

<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть автора</div> 
<?php $this->widget('LibraryAuthorWidget', array('model'=>$authors)); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>