<?php
/* @var $this GdzClasController */
/* @var $model GdzClas */

$this->breadcrumbs=array(
	'Gdz Clases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GdzClas', 'url'=>array('index')),
	array('label'=>'Create GdzClas', 'url'=>array('create')),
	array('label'=>'Update GdzClas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GdzClas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GdzClas', 'url'=>array('admin')),
);
?>

<h1>Вид гдз класса #<?php echo $model->id; ?></h1>

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
