<?php
/* @var $this GdzClasController */
/* @var $model GdzClas */

$this->breadcrumbs=array(
	'Gdz Clases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GdzClas', 'url'=>array('index')),
	array('label'=>'Manage GdzClas', 'url'=>array('admin')),
);
?>

<h1>Создать гдз класс</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>