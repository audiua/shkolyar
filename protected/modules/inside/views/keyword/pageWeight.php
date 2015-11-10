

<div class="title">Manage page weight</div>
<div class="clear"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'keyword-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	// 'rowCssClassExpression' => '( $data["google_view"] < 10 && $data["yandex_view"]) ? "grey" : "" )',
	'columns' => array(
        [
            'name' => 'id',
            'htmlOptions' => [
                'style' => 'width: 30px; text-align: center;'
            ]
        ],
		array(
			'name'=>'url',
			'value'=>' CHtml::link($data->url,$data->url, array("target"=>"_blank", "class"=>"link"))',
			'type'=>'raw',
		),
        [
            'header' => 'in',
            'value'=>'count($data->link_in)',
            'htmlOptions' => [
                'style' => 'width: 30px; text-align: center;'
            ]
        ],

        [
            'header' => 'out',
            'value'=>'count($data->link_out)',
            'htmlOptions' => [
                'style' => 'width: 30px; text-align: center;'
            ]
        ],
        array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('width'=>'80px'),
			'buttons'=>array(
				'view'=>array('url'=>'"/inside/keyword/pageWeightView/$data->id"'),

			)
		),
    ),
)); ?>

