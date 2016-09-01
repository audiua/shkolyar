<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo  $model->title; ?> </h1>

<div class="clear"></div>
<div class="separator task-separator"></div>

<div class="center">
	<!-- admitad.banner: 4ss1yy7fyeedbcdfe0b68753afd1f1 Letyshops -->
	<a target="_blank" rel="nofollow" href="https://lenkmio.com/g/4ss1yy7fyeedbcdfe0b68753afd1f1/?i=4&subid=sh"><img width="500" height="500" border="0" src="https://ad.admitad.com/b/4ss1yy7fyeedbcdfe0b68753afd1f1/" alt="Letyshops"/></a>
	<!-- /admitad.banner -->
</div>

<div class="clear"></div>
<div class="separator task-separator"></div>
<div class="knowall-article">
	
<?php echo  $model->text; ?>
<?php $this->renderDynamic('getUpdateBtn', array('id'=>$model->id)); ?>
</div>

<?php //$this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>



<div class="clear"></div>
<div class="separator"></div>

<div class="info">Схожі твори для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeWritingWidget.RelativeWritingWidget');
	$this->widget('RelativeWritingWidget', array('article'=>$model)); ?>
</div>
