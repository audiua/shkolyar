<?php
/* @var $this TextbookBookController */
/* @var $model TextbookBook */

$this->breadcrumbs=array(
	'Textbook Books'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TextbookBook', 'url'=>array('index')),
	array('label'=>'Create TextbookBook', 'url'=>array('create')),
	array('label'=>'View TextbookBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TextbookBook', 'url'=>array('admin')),
);
?>

<h1>Update TextbookBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>