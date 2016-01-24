<div class="book-list">

<div class="clear"></div>
<?php

$subject = $this->controller->id.'_subject_id';
$clas = $this->controller->id.'_clas_id';
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'t_m_item',
    'summaryText' => '',
    // 'sorterHeader' => 'Сортувати по: ',
 //    'pager'=>array(
 //    	'header' => '',
 //    	'firstPageLabel'=>'<<',
 //        'prevPageLabel'=>'<',
 //        'nextPageLabel'=>'>',
 //        'lastPageLabel'=>'>>',
 //        'cssFile'=>false,
	// 	'internalPageCssClass'=>'pager_li',
	// ),
    'pager'=>'LinkPager',
	'emptyText'=>'А нету никаких книг!',
    'sortableAttributes'=>array(
        'author',
        $subject,
        $clas,
    ),
    'template'=>"{items}\n{pager}",
    'ajaxUpdate'=>false,
));
?>
</div>
