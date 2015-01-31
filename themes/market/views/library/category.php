<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<div class="info">Біографія <?php echo $category->author; ?></div> 
<div class="description">
<?php echo $category->description; ?>
</div>

<div class="info">Твори автора</div>
<?php $this->widget('DataLibraryWidget', array('model'=>$model)); ?>