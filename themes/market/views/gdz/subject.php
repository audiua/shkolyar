<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo $this->h1; ?></h1>

<div class="description">
  <?php  echo $this->subjectModel->description; ?>
</div>
<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<div class="info">Збірники ГДЗ</div> 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>


<?php //$this->widget('BookWidget', array('model'=>$this->subjectModel->gdz_book)); ?>



  
