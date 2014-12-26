<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */

$this->breadcrumbs=array(
	'Gdz Subjects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GdzSubject', 'url'=>array('index')),
	array('label'=>'Create GdzSubject', 'url'=>array('create')),
	array('label'=>'View GdzSubject', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GdzSubject', 'url'=>array('admin')),
);
?>

<h1>Update GdzSubject <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>