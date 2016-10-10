<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1>Твори <?php echo $this->subjectModel->title; ?></h1>

<div class="description">
  <?php  echo $description; ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть клас</div>

<?php $this->widget('ClasNumbWritingCurrentSubjectWidget', array('subject'=>$this->subjectModel)); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>

<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>