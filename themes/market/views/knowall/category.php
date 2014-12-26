<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<div class="info"><?php echo $category->title; ?></div> 
<p class="description">
<?php echo $category->description; ?>
</p>

<?php $this->widget('DataArticleWidget', array('model'=>$model)); ?>