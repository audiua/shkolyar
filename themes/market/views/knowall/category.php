<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo $category->title; ?></h1> 

<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'knowall', 'action'=>'category', 'category_id'=>$category->id))); ?>
</div>


<?php $this->widget('DataArticleWidget', array('model'=>$model, 'params'=>array('linkCategory'=>false))); ?>
<div class="clear"></div>
<div class="separator"></div>