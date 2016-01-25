<?php  

$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>


<h1>Підручники <?php echo $this->param['clas'] . ' клас ' . $this->subjectModel->name; ?></h1>

<div class="description">
  <?php echo $this->subjectModel->description; ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>

<div class="info">Виберіть підручник</div> 
 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>



  
