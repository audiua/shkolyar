<?php
/* @var $this TextbookClasController */
/* @var $model TextbookClas */

$this->breadcrumbs=array(
	'Textbook Clases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TextbookClas', 'url'=>array('index')),
	array('label'=>'Create TextbookClas', 'url'=>array('create')),
	array('label'=>'View TextbookClas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TextbookClas', 'url'=>array('admin')),
);
?>

<h1>Update TextbookClas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>