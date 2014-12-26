<?php
/* @var $this LibraryAuthorController */
/* @var $model LibraryAuthor */

$this->breadcrumbs=array(
	'Library Authors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LibraryAuthor', 'url'=>array('index')),
	array('label'=>'Manage LibraryAuthor', 'url'=>array('admin')),
);
?>

<h1>Create LibraryAuthor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>