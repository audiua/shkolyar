
<!-- <div class="view-filters">
	<span class="view-filter glyphicon glyphicon-th-large gray active-filter" data-view='middle-book-block'></span> 
	<span class="view-filter glyphicon glyphicon-th gray " data-view='small-book-block'></span>  
	<span class="view-filter glyphicon glyphicon-th-list gray" data-view='list-book-block'></span> 
</div> -->

<!-- <div class="clear"></div> -->

<div class="article-list">
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_item',
    'summaryText' => '',
    'sorterHeader' => 'Сортувати по: ',
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
	'emptyText'=>'No article!',
    'sortableAttributes'=>array(
        'title',
        // 'update_time',
    ),
    // 'template'=>"{items}\n{pager}",
    'ajaxUpdate'=>false,
));
?>
</div>
