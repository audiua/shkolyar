<?php
/* @var $this KnowallController */
/* @var $model Knowall */

$this->breadcrumbs=array(
	'Knowalls'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Knowall', 'url'=>array('index')),
	array('label'=>'Create Knowall', 'url'=>array('create')),
	array('label'=>'Update Knowall', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Knowall', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Knowall', 'url'=>array('admin')),
);
?>

<h1>View Knowall #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'text',
		'knowall_category_id',
		'create_time',
		'update_time',
		'public',
		'description',
		'slug',
	),
)); ?>
