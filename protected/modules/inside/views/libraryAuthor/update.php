<?php
/* @var $this LibraryAuthorController */
/* @var $model LibraryAuthor */

$this->breadcrumbs=array(
	'Library Authors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LibraryAuthor', 'url'=>array('index')),
	array('label'=>'Create LibraryAuthor', 'url'=>array('create')),
	array('label'=>'View LibraryAuthor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LibraryAuthor', 'url'=>array('admin')),
);
?>

<h1>Update LibraryAuthor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>