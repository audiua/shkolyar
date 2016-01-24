<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down"></span></span></noindex>',
));
?>

<h1><?php echo $this->h1; ?></h1>

<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('OneBookWidget', array('model'=>$this->bookModel)); ?>	
	</div>
	
</div>

<?php if($embedConfigId): ?>
<iframe width="700" height="500" src="//e.issuu.com/embed.html#<?= $embedConfigId; ?>" frameborder="0" allowfullscreen></iframe>
<?php endif; ?>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>


<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі підручники для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeTextbookWidget.RelativeTextbookWidget');
	$this->widget('RelativeTextbookWidget'); ?>
</div>