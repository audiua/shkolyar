<h1>Всезнайка</h1>

<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'knowall', 'action'=>'index'))); ?>
</div>

<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть категорію</div>

<?php $this->widget('KnowallCategoryWidget', array('model'=>$category)); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть статтю</div>
<?php $this->widget('DataArticleWidget', array('model'=>$model, 'params'=>array('linkCategory'=>true))); ?>
<div class="clear"></div>
<div class="separator"></div>