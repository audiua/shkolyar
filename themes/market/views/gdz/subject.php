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
<h1><?php echo $this->h1.$pageStr; ?></h1>

<?php if(!$page): ?>
<div class="description">
  <?php  echo $this->subjectModel->description; ?>
</div>
<?php endif; ?>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>

<div class="info">Збірники ГДЗ</div> 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>


<?php //$this->widget('BookWidget', array('model'=>$this->subjectModel->gdz_book)); ?>



  
