<?php
/* @var $this KnowallCategoryController */
/* @var $model KnowallCategory */

$this->breadcrumbs=array(
	'Knowall Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List KnowallCategory', 'url'=>array('index')),
	array('label'=>'Create KnowallCategory', 'url'=>array('create')),
	array('label'=>'Update KnowallCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete KnowallCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KnowallCategory', 'url'=>array('admin')),
);
?>

<h1>View KnowallCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'create_time',
		'update_time',
		'slug',
		'description',
	),
)); ?>
