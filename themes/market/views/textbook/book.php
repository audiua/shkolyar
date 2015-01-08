<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down"></span></span></noindex>',
));
?>

<?php $this->widget('BreadcrumbsWidget'); ?>

<h1><?php echo $this->h1; ?></h1>

<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('OneBookWidget', array('model'=>$this->bookModel)); ?>	
	</div>
	
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="clear"></div>
<div class="separator task-separator"></div>
<div class="task">
	<div class="task-title info">Сторінка <span class='page-number'></span>
	</div>
	<section id="inverted-contain">
	  <div class="buttons">
	    <button class="zoom-out"><span class="glyphicon glyphicon-zoom-out "></span></button>
	    <input type="range" class="zoom-range">
	    <button class="zoom-in"><span class="glyphicon glyphicon-zoom-in "></span></button>
	    <button class="reset"><span class="glyphicon glyphicon-remove"></span></button>
	  </div>
	  <div class="panzoom-parent"></div>
	  <span class="b-left"><span class="glyphicon glyphicon-arrow-left big" aria-hidden="true"></span></span>	
	  <span class="b-right"><span class="glyphicon glyphicon-arrow-right big" aria-hidden="true"></span></span>
	  <style>
	    #inverted-contain .panzoom { width: 100%; height: 100%;  }
	  </style>
	</section>
</div>



<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#view-page" role="tab" data-toggle="tab">Переглянути по сторінкам</a></li>
  <li><a href="#view-book" role="tab" data-toggle="tab">Переглянути журналом</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="view-page">
  	
  	<div class="task">
  		
  	</div>
  	<div class="clear"></div>
  	<!-- <div class="separator"></div> -->
  	<div class="info">Виберіть сторінку: </div>
  	<div class="task-block">
  		<?php $this->widget('TaskWidget'); ?>
  	</div>
  </div>
  <div class="tab-pane" id="view-book">
	<!-- <iframe src="//v.calameo.com/?bkcode=003876070dcf595c00ad2" width="870" height="600" frameborder="0" scrolling="no" allowtransparency allowfullscreen style="margin:0 auto;"></iframe> -->
  </div>
</div>






