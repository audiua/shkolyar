<?php
/* @var $this WritingController */
/* @var $model Writing */

$this->breadcrumbs=array(
	'Writings'=>array('index'),
	'Manage',
);

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', '/inside/admin/index'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#writing-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title">Manage Writings</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'writing-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id' => array(
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30px')
		),
		'thumbnail'=>array(
			'name'=>'thumbnail',
			'type' => 'image',
			// 'value'=>'Yii::app()->baseUrl . "/img/textbook/" . $data->textbook_clas->clas->slug . "/" . $data->textbook_subject->subject->slug ."/". $data->slug."/book/" . $data->slug.".".$data->img',
			'value'=>'$data->getThumb(77,90,"crop")'
		),
		'clas_id'=>array(
			'name'=>'clas_id',
			'value'=>'$data->clas->title',
			'header'=>'Клас',
			'htmlOptions'=>array('width'=>'30px')
		),
		'subject_id'=>array(
			'name'=>'subject_id',
			'value'=>'$data->subject->title',
			'header'=>'Предмет',
			'htmlOptions'=>array('width'=>'60px')
		),
		'create_time'=>array(
			'name'=>'create_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/mm/dd HH:mm\', $data->create_time)',
			'htmlOptions'=>array('width'=>'150px')
		),
		'update_time'=>array(
			'name'=>'update_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/mm/dd HH:mm\', $data->update_time)',
			'htmlOptions'=>array('width'=>'150px')
		),
		'public_time'=>array(
			'name'=>'public_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/mm/dd HH:mm\', $data->public_time)',
			'htmlOptions'=>array('width'=>'150px')
		),
		
		// 'content',
		'title',
		'slug',
		'length',
		'nausea',
		// 'img_ext',
		
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'80px')
		),
	),
)); ?>
