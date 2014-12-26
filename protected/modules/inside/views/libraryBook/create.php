<?php
/* @var $this LibraryBookController */
/* @var $model LibraryBook */

$this->breadcrumbs=array(
	'Library Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LibraryBook', 'url'=>array('index')),
	array('label'=>'Manage LibraryBook', 'url'=>array('admin')),
);
?>

<h1>Create LibraryBook</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>