<?php
/* @var $this LibraryAuthorController */
/* @var $model LibraryAuthor */

$this->breadcrumbs=array(
	'Library Authors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LibraryAuthor', 'url'=>array('index')),
	array('label'=>'Create LibraryAuthor', 'url'=>array('create')),
	array('label'=>'Update LibraryAuthor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LibraryAuthor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LibraryAuthor', 'url'=>array('admin')),
);
?>

<h1>View LibraryAuthor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'author',
		'create_time',
		'update_time',
		'descripiton',
		'slug',
	),
)); ?>
