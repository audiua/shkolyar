<?php
/* @var $this TextbookClasController */
/* @var $model TextbookClas */

$this->breadcrumbs=array(
	'Textbook Clases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TextbookClas', 'url'=>array('index')),
	array('label'=>'Manage TextbookClas', 'url'=>array('admin')),
);
?>

<h1>Create TextbookClas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>