
<!-- <div class="clear"></div> -->

<div class="book-list">

<!-- <div class="view-filters">
	<span class="view-filter glyphicon glyphicon-th-large gray active-filter" data-view='middle-book-block'></span> 
	<span class="view-filter glyphicon glyphicon-th gray " data-view='small-book-block'></span>  
	<span class="view-filter glyphicon glyphicon-th-list gray" data-view='list-book-block'></span> 
</div> -->
<div class="clear"></div>
<?php

$subject = $this->controller->id.'_subject_id';
$clas = $this->controller->id.'_clas_id';
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'t_item',
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
