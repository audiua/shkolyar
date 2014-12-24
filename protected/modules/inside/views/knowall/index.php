<?php
/* @var $this KnowallController */
/* @var $model Knowall */

$this->breadcrumbs=array(
	'Knowalls'=>array('index'),
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
	$('#knowall-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title">Manage Knowalls</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->user->hasFlash('KNOWALL_FLASH')):?>
    <div class="alert alert-success" role="alert">
	    <button type="button" class="close" data-dismiss="alert">
		    <span aria-hidden="true">&times;</span>
		    <span class="sr-only">Close</span>
	    </button>
    	<?php echo Yii::app()->user->getFlash('KNOWALL_FLASH'); ?>
    </div>
        
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'knowall-grid',
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
		'title'=>array(
			'name'=>'title',
			'value'=>' CHtml::link($data->title,$data->url, array("target"=>"_blank", "class"=>"link"))',
			'type'=>'raw'
		),
		'knowall_category_id'=>array(
			'name'=>'knowall_category_id',
			'value'=>'$data->knowall_category->title',
			'header'=>'Предмет',
			'htmlOptions'=>array('width'=>'150px')
		),
		'create_time'=>array(
			'name'=>'create_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/MM/dd HH:mm\', $data->create_time)',
		),
		'update_time'=>array(
			'name'=>'update_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/MM/dd HH:mm\', $data->update_time)'
		),
		'public_time'=>array(
			'name'=>'public_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/MM/dd HH:mm\', $data->public_time)'
		),
		'public'=>array(
			'name'=>'public',
			'value'=>'$data->public==1 ? "Да":"Нет"',
			'headerHtmlOptions'=>array('width'=>'20px'),
		),
		'slug',
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'80px')
		),
	),
)); ?>
