<?php
/* @var $this WritingController */
/* @var $model Writing */

$this->breadcrumbs=array(
	'Writings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Writing', 'url'=>array('index')),
	array('label'=>'Create Writing', 'url'=>array('create')),
	array('label'=>'Update Writing', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Writing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Writing', 'url'=>array('admin')),
);
?>

<h1>View Writing #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'clas_id',
		'subject_id',
		'create_time',
		'update_time',
		'public_time',
		'text',
		'title',
		'slug',
		'length',
		'nausea',
		'thumbnail_ext',
	),
)); ?>
