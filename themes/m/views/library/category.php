<h1><?php echo $category->author; ?> - Біографія</h1>
<div class="description">
<?php echo $category->description; ?>
<?php $this->renderDynamic('getUpdateAuthorBtn', array('id'=>$category->id)); ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<h4 class="info">Твори автора</h4>
<?php $this->widget('DataLibraryWidget', array('model'=>$model)); ?>