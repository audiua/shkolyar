<?php
/* @var $this KnowallController */
/* @var $model Knowall */

$this->breadcrumbs=array(
	'Knowalls'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Knowall', 'url'=>array('index')),
	array('label'=>'Create Knowall', 'url'=>array('create')),
	array('label'=>'View Knowall', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Knowall', 'url'=>array('admin')),
);
?>

<h1>Update Knowall <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>