<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>
<h1>Всезнайка</h1>

<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'knowall', 'action'=>'index'))); ?>
</div>

<?php $this->widget('LikeWidget'); ?>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<div class="info">Виберіть категорію</div>

<?php $this->widget('KnowallCategoryWidget', array('model'=>$category)); ?>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть статтю</div>
<?php $this->widget('DataArticleWidget', array('model'=>$model, 'params'=>array('linkCategory'=>true))); ?>
<div class="clear"></div>
<div class="separator"></div>