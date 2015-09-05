<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-top'))); ?>
<div class="clear"></div>

<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<?php 
$pageStr='';
if($page){$pageStr=' Cторінка '.$page;} ?>
<h1><?php echo $this->h1 . $pageStr; ?></h1>

<?php if(!$page): ?>
<div class="description">
  <?php  echo $this->clasModel->description; ?>
</div>
<?php endif; ?>
  
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть предмет для <?php  echo $this->clasModel->clas->slug; ?> класу</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->gdz_subject)); ?>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>


<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>