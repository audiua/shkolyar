<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>
<h1>Твори <?php echo $this->param['clas'] . ' клас'; ?></h1>

<?php echo $description; ?>

<div class="separator"></div>
<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWritingWidget', array('model'=>Subject::model()->findAll())); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>