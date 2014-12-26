<?php
/* @var $this TextbookSubjectController */
/* @var $model TextbookSubject */

$this->breadcrumbs=array(
	'Textbook Subjects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TextbookSubject', 'url'=>array('index')),
	array('label'=>'Create TextbookSubject', 'url'=>array('create')),
	array('label'=>'Update TextbookSubject', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TextbookSubject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TextbookSubject', 'url'=>array('admin')),
);
?>

<h1>View TextbookSubject #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'create_time',
		'update_time',
		'subject_id',
		'textbook_clas_id',
	),
)); ?>
