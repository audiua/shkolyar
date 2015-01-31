<?php
/* @var $this TextbookBookController */
/* @var $model TextbookBook */

$this->breadcrumbs=array(
	'Textbook Books'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update TextbookBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>