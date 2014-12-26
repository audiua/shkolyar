<?php
/* @var $this TextbookClasController */
/* @var $model TextbookClas */

$this->breadcrumbs=array(
	'Textbook Clases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TextbookClas', 'url'=>array('index')),
	array('label'=>'Create TextbookClas', 'url'=>array('create')),
	array('label'=>'Update TextbookClas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TextbookClas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TextbookClas', 'url'=>array('admin')),
);
?>

<h1>View TextbookClas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'clas_id',
		'create_time',
		'update_time',
	),
)); ?>
