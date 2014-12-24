<?php
/* @var $this KnowallCategoryController */
/* @var $model KnowallCategory */

$this->breadcrumbs=array(
	'Knowall Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KnowallCategory', 'url'=>array('index')),
	array('label'=>'Create KnowallCategory', 'url'=>array('create')),
	array('label'=>'View KnowallCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage KnowallCategory', 'url'=>array('admin')),
);
?>

<h1>Update KnowallCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>