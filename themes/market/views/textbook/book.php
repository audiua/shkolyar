<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down"></span></span>',
));
?>

<?php $this->widget('BreadcrumbsWidget'); ?>

<h1><?php echo $this->h1; ?></h1>



<div class="info"></div>
<div class="book-list">
	<div class="big-book-block">
	<?php $this->widget('OneBookWidget', array('model'=>$this->bookModel)); ?>

		<!-- <div class=""><img class="img-middle-book thumbnail" src="http://placehold.it/150x200" alt=""> </div>
  		<div class="">
  			<div class="book-author">author</div>
  			<div class="book-subject">subject</div>
  			<div class="book-clas">clas</div>
  			<div class="desc">
  				<p>Book Book Book Book Book Book Book Book Book Book
  				Book Book Book Book Book</p>
  			</div>

  		</div>
		<div class="textbook-link">
			<a href="#">textbook</a>
		</div> -->
					
	</div>
	
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="clear"></div>
<div class="separator task-separator"></div>
<noindex>
    <div class="h_ads">
        <img src="/images/horisont.png" alt="">
    </div>
</noindex>
<div class="task">
	<div class="task-title info">Сторинка: 
	</div>
	<section id="inverted-contain">
	  <div class="buttons">
	    <button class="zoom-out"><span class="glyphicon glyphicon-zoom-out "></span></button>
	    <input type="range" class="zoom-range">
	    <button class="zoom-in"><span class="glyphicon glyphicon-zoom-in "></span></button>
	    <button class="reset"><span class="glyphicon glyphicon-remove"></span></button>
	  </div>
	  
	  <div class="panzoom-parent"></div>
	  <style>
	    #inverted-contain .panzoom { width: 100%; height: 100%;  }
	  </style>
	 <!--  <script>
	    (function() {
	      var $section = $('#inverted-contain');
	      $section.find('.panzoom').panzoom({
	        $zoomIn: $section.find(".zoom-in"),
	        $zoomOut: $section.find(".zoom-out"),
	        $zoomRange: $section.find(".zoom-range"),
	        $reset: $section.find(".reset"),
	        startTransform: 'scale(0.9)',
            increment: 0.1,
            minScale: 1,
            contain: 'invert'
	      }).panzoom('zoom');
	    })();
	  </script> -->
	 
	</section>
</div>



<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#view-page" role="tab" data-toggle="tab">Переглянути по сторинкам</a></li>
  <li><a href="#view-book" role="tab" data-toggle="tab">Пенлянути журналом</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="view-page">
  	
  	<div class="task">
  		
  	</div>
  	<div class="clear"></div>
  	<!-- <div class="separator"></div> -->
  	<div class="info">Виберить сторинку: </div>
  	<div class="task-block">
  		<?php $this->widget('TaskWidget'); ?>
  	</div>
  </div>
  <div class="tab-pane" id="view-book">
	<iframe src="//v.calameo.com/?bkcode=003876070dcf595c00ad2" width="870" height="600" frameborder="0" scrolling="no" allowtransparency allowfullscreen style="margin:0 auto;"></iframe>
  </div>
</div>






