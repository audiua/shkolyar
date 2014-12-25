<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<div class="info">Всезнайка</div> 
<p class="description">
У роздили Всезнайка - зибрани цикави статьи на ризни тематики
</p>

<?php $this->widget('DataArticleWidget', array('model'=>$model)); ?>