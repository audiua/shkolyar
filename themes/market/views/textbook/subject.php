<?php  

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Підручники <?php echo $this->param['clas'] . ' клас ' . $this->subjectModel->subject->title; ?></h1>

<div class="description">
  <?php echo $this->subjectModel->description; ?>
</div>
<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<div class="info">Виберіть підручник</div> 
 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>



  
