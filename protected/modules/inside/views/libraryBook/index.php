<?php
/* @var $this LibraryBookController */
/* @var $model LibraryBook */

$this->breadcrumbs=array(
	'Library Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LibraryBook', 'url'=>array('index')),
	array('label'=>'Create LibraryBook', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#library-book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title">Manage Library Books</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'library-book-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id' => array(
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30px')
		),
		'title',
		'img_ext'=>array(
			'name'=>'img_ext',
			'type' => 'image',
			'header'=>'Обложка',
			'value'=>'Yii::app()->baseUrl . "/img/library/" . $data->library_author->slug . "/" . $data->slug ."/book/"."first.".$data->img_ext',
			'htmlOptions' => array('class'=>'mini-book', 'width'=>'60px'),
		),
		'slug',
		'description',
		'library_author_id',
		'create_time'=>array(
			'name'=>'create_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/MM/dd HH:mm\', $data->create_time)',
		),
		'update_time'=>array(
			'name'=>'update_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/MM/dd HH:mm\', $data->update_time)'
		),
		'public',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'80px')
		),

	),
)); ?>
