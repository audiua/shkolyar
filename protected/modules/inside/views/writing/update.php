<?php
/* @var $this WritingController */
/* @var $model Writing */

$this->breadcrumbs=array(
	'Writings'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Writing', 'url'=>array('index')),
	array('label'=>'Create Writing', 'url'=>array('create')),
	array('label'=>'View Writing', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Writing', 'url'=>array('admin')),
);
?>

<h1>Update Writing <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>