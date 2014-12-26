<?php
/* @var $this LibraryBookController */
/* @var $model LibraryBook */

$this->breadcrumbs=array(
	'Library Books'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LibraryBook', 'url'=>array('index')),
	array('label'=>'Create LibraryBook', 'url'=>array('create')),
	array('label'=>'View LibraryBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LibraryBook', 'url'=>array('admin')),
);
?>

<h1>Update LibraryBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>