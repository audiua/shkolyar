<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span>',
));
?>


<h1><?php echo $this->h1; ?></h1>
<div class="description">
  <?php  echo $description; ?>
</div>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть клас для предмета <?php echo $subject->title ?> </div>

<?php $this->widget('ClasNumbCurrentSubjectWidget', array('subject'=>$subject)); ?>


<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>

<?php $this->widget('DataBookWidget', array('model'=>$books, 'params'=>array('subject'=>$subject->title))); ?>



  
