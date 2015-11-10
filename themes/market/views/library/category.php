<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>
<h1><?php echo $category->author; ?> - Біографія</h1>
<div class="description">
<?php echo $category->description; ?>
<?php $this->renderDynamic('getUpdateAuthorBtn', array('id'=>$category->id)); ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<h2 class="info">Твори автора <?php echo $category->author; ?></h2>
<?php $this->widget('DataLibraryWidget', array('model'=>$model)); ?>