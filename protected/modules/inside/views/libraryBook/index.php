<?php
/* @var $this LibraryBookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Library Books',
);

$this->menu=array(
	array('label'=>'Create LibraryBook', 'url'=>array('create')),
	array('label'=>'Manage LibraryBook', 'url'=>array('admin')),
);
?>

<h1>Library Books</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
