<?php
/* @var $this TextbookSubjectController */
/* @var $model TextbookSubject */

$this->breadcrumbs=array(
	'Textbook Subjects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TextbookSubject', 'url'=>array('index')),
	array('label'=>'Create TextbookSubject', 'url'=>array('create')),
	array('label'=>'View TextbookSubject', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TextbookSubject', 'url'=>array('admin')),
);
?>

<h1>Update TextbookSubject <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>