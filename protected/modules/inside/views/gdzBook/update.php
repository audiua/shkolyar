<?php
/* @var $this GdzBookController */
/* @var $model GdzBook */

$this->breadcrumbs=array(
	'Gdz Books'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GdzBook', 'url'=>array('index')),
	array('label'=>'Create GdzBook', 'url'=>array('create')),
	array('label'=>'View GdzBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GdzBook', 'url'=>array('admin')),
);
?>

<h1>Update GdzBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>