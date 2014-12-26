<?php
/* @var $this LibraryBookController */
/* @var $model LibraryBook */

$this->breadcrumbs=array(
	'Library Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List LibraryBook', 'url'=>array('index')),
	array('label'=>'Create LibraryBook', 'url'=>array('create')),
	array('label'=>'Update LibraryBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LibraryBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LibraryBook', 'url'=>array('admin')),
);
?>

<h1>View LibraryBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'img_ext',
		'description',
		'library_author_id',
		'create_time',
		'update_time',
	),
)); ?>
