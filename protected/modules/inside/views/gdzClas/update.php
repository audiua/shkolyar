<?php
/* @var $this GdzClasController */
/* @var $model GdzClas */

$this->breadcrumbs=array(
	'Gdz Clases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GdzClas', 'url'=>array('index')),
	array('label'=>'Create GdzClas', 'url'=>array('create')),
	array('label'=>'View GdzClas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GdzClas', 'url'=>array('admin')),
);
?>

<h1>Обновить гдз класс <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>