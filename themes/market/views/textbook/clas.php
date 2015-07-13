<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-top'))); ?>
<div class="clear"></div>

<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Підручники <?php echo $this->param['clas'] . ' клас'; ?></h1>

<div class="description">
  <?php echo $this->clasModel->description; ?>
</div>
<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->textbook_subject)); ?>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>