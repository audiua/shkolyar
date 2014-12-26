<?php
/* @var $this GdzBookController */
/* @var $model GdzBook */

$this->breadcrumbs=array(
	'Gdz Books'=>array('index'),
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
	$('#gdz-book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="title">Manage Gdz Books</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->user->hasFlash('CLAS_FLASH')):?>
    <div class="alert alert-success" role="alert">
	    <button type="button" class="close" data-dismiss="alert">
		    <span aria-hidden="true">&times;</span>
		    <span class="sr-only">Close</span>
	    </button>
    	<?php echo Yii::app()->user->getFlash('CLAS_FLASH'); ?>
    </div>
        
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gdz-book-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id' => array(
			'name'=>'id',
			'value'=>'$data->id',
			'htmlOptions'=>array('width'=>'30px')
		),
		'img'=>array(
			'name'=>'img',
			'type' => 'image',
			'value'=>'Yii::app()->baseUrl . "/img/gdz/" . $data->gdz_clas->clas->slug . "/" . $data->gdz_subject->subject->slug ."/". $data->slug."/book/" . $data->slug.".".$data->img',
			'htmlOptions' => array('class'=>'mini-book', 'width'=>'60px'),
		),
		'title',
		'author' => array(
			'name'=>'author',
			'value'=>'$data->author',
			'htmlOptions'=>array('width'=>'170px')
		),
		'gdz_clas_id'=>array(
			'name'=>'gdz_clas_id',
			'value'=>'$data->gdz_clas->clas->slug',
			'header'=>'Клас',
			'htmlOptions'=>array('width'=>'30px')
		),
		'gdz_subject_id'=>array(
			'name'=>'subject_id',
			'value'=>'$data->gdz_subject->subject->title',
			'header'=>'Предмет',
			'htmlOptions'=>array('width'=>'130px')
		),
		'slug',
		
		'description'=>array(
			'name'=>'description',
			'value'=>'$data->description',
			'htmlOptions'=>array('width'=>'750px')
		),
		'year',
		'public_time'=>array(
			'name'=>'public_time',
			'value'=>'Yii::app()->dateFormatter->format(\'yyyy/mm/dd HH:mm\', $data->public_time)',
			'htmlOptions'=>array('width'=>'150px')
		),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'10px')
		),
	),
)); ?>
