<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */

$this->breadcrumbs=array(
	'Gdz Subjects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GdzSubject', 'url'=>array('index')),
	array('label'=>'Create GdzSubject', 'url'=>array('create')),
	array('label'=>'Update GdzSubject', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GdzSubject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GdzSubject', 'url'=>array('admin')),
);
?>

<h1>View GdzSubject #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'create_time',
		'update_time',
		'gdz_clas_id',
		'subject_id',
	),
)); ?>
