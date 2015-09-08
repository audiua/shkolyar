<?php
/* @var $this WritingController */
/* @var $model Writing */

$this->breadcrumbs=array(
	'Writing'=>array('index'),
	'Manage',
);

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', '/inside/admin/index'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));

?>

<div class="title">Manage Writing</div> <a class="btn btn-success" href="<?php echo $this->createUrl('create'); ?>" role="button"> + Створити</a>
<div class="clear"></div>


<?php if(Yii::app()->user->hasFlash('Writing_FLASH')):?>
	<br>
    <div class="alert alert-success" role="alert">
	    <button type="button" class="close" data-dismiss="alert">
		    <span aria-hidden="true">&times;</span>
		    <span class="sr-only">Close</span>
	    </button>
    	<?php echo Yii::app()->user->getFlash('Writing_FLASH'); ?>
    </div>
<?php endif; ?>


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
		'public_time'=>array(
			'name'=>'public_time',
			'value'=>'$data->public_time',
			'htmlOptions'=>array('width'=>'150px')
		),
		
		// 'content',
		'title',
		'slug',
		'length',
		'nausea' => array(
			'name'=>'nausea',
			'value'=>'$data->nausea."%"',
			'htmlOptions'=>array('width'=>'30px')
		),
		'public'=>array(
			'name'=>'public',
			'value'=>'$data->public==1 ? "Да":"Нет"',
			'headerHtmlOptions'=>array('width'=>'20px'),
		),
		// 'img_ext',
		
		array(
			'class'=>'CButtonColumn',
			'template'=>(Yii::app()->user->role==="moderator")?'{view}{update}':'{view}{update}{delete}',
			'htmlOptions'=>array('width'=>'80px')
		),
	),
)); ?>
