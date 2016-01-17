<?php  
$this->widget('BreadcrumbsWidget', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>SeoHide::link(Yii::app()->homeUrl, '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>'),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo  $model->title ; ?> </h1> 

<div class="info"><?php echo  $model->library_author->author ; ?></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('LibraryBookWidget', array('model'=>$model)); ?>	
	</div>
</div>
<?php $this->renderDynamic('getUpdateBookBtn', array('id'=>$model->id)); ?>




<div class="clear"></div>
<div class="separator task-separator"></div>


<div class="task">
	<div class="task-title info">Повний текст твору: 
	</div>
	<section id="inverted-contain">
		<div class="loading"></div>
        <div class="darking"></div>
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

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_netboard_middle'))); ?>

<div class="info">Виберіть сторінку</div>
<div class="task-block">
	<?php $this->widget('LibraryTaskWidget'); ?>
</div>


<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі твори художньої літератури:</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeLibraryWidget.RelativeLibraryWidget');
	$this->widget('RelativeLibraryWidget', array('book'=>$model)); ?>
</div>