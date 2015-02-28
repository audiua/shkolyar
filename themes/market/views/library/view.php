<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>
<h1><?php echo  $model->title ; ?> </h1>

<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
		<?php $this->widget('LibraryBookWidget', array('model'=>$model)); ?>	
	</div>
</div>
<?php $this->renderDynamic('getUpdateBookBtn', array('id'=>$model->id)); ?>


<?php $this->widget('LikeWidget'); ?>

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

<div class="full-banner">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- sh полный баннер -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-9657826060070920"
	     data-ad-slot="7589407895"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>

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