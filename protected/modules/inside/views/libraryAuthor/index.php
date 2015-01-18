<?php
/* @var $this LibraryAuthorController */
/* @var $model LibraryAuthor */

$this->breadcrumbs=array(
	'Library Authors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LibraryAuthor', 'url'=>array('index')),
	array('label'=>'Create LibraryAuthor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#library-author-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title">Manage Library Authors</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'library-author-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id' => array(
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30px')
		),
		'author',
		'create_time'=>array(
			'name'=>'create_time',
			'value'=>'Yii::app()->dateFormatter->format(\'HH:mm:ss d MMMM yyyy\', $data->create_time)',
		),
		'update_time'=>array(
			'name'=>'update_time',
			'value'=>'Yii::app()->dateFormatter->format(\'HH:mm:ss d MMMM yyyy\', $data->update_time)'
		),
		'slug',
		// 'description',
		'length',
		'nausea'=>array(
			'name'=>'nausea',
			'value'=>'$data->nausea."%"',
			'headerHtmlOptions'=>array('width'=>'30px'),
		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'80px')
		),
	),
)); ?>
