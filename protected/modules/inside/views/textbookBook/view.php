<?php
/* @var $this TextbookBookController */
/* @var $model TextbookBook */

$this->breadcrumbs=array(
	'Textbook Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TextbookBook', 'url'=>array('index')),
	array('label'=>'Create TextbookBook', 'url'=>array('create')),
	array('label'=>'Update TextbookBook', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TextbookBook', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TextbookBook', 'url'=>array('admin')),
);
?>

<h1>View TextbookBook #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'author',
		'textbook_clas_id',
		'textbook_subject_id',
		'slug',
		'img',
		'description',
		'year',
		'properties',
		'pagination',
		'lang',
		'public',
		'create_time',
		'update_time',
		'public_time',
		'edition',
		'info',
	),
)); ?>
