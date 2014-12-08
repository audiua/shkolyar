<?php  

$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'inactiveLinkTemplate'=>'<span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span>',
));
?>
<div class="detail-breadcrumbs">
<nav class="navbar navbar-default clas-menu" role="navigation">
  <div class="container-fluid clas-menu">
	<!-- Brand and toggle get grouped for better mobile display -->
	<!-- <div class="navbar-header">
	  <a class="navbar-brand" href="#">back</a>
	</div> -->

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	  
	  <ul class="nav navbar-nav">


		<li class="active"><a href="#">5</a></li>
		<li><a href="#">6</a></li>
		<li><a href="#">7</a></li>
		<li><a href="#">8</a></li>
		<li><a href="#">9</a></li>
		<li><a href="#">10</a></li>
		<li><a href="#">11</a></li>
		
	  </ul>
	  
	  
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<nav class="navbar navbar-default clas-menu" role="navigation">
  <div class="container-fluid clas-menu">
	<!-- Brand and toggle get grouped for better mobile display -->
	<!-- <div class="navbar-header">
	  <a class="navbar-brand" href="#">back</a>
	</div> -->

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	

	  <ul class="nav navbar-nav">
		<li ><a href="#">Математика</a></li>
		<li><a href="#">Физика</a></li>
		<li><a href="#">Химия</a></li>
		<li><a href="#">Укринский язык</a></li>
		<li><a href="#">Русский язык</a></li>
		<li><a href="#">Геграфия</a></li>
		<li class="active"><a href="#">Биология</a></li>
		
	  </ul>
	  
	  
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</div>

  <div class="info">Выберите підручники</div> 
  <div class="view-filters">
	  <span class="view-filter glyphicon glyphicon-th-large gray active-filter" data-view='middle-book-block'></span> 
	  <span class="view-filter glyphicon glyphicon-th gray " data-view='small-book-block'></span>  
	  <span class="view-filter glyphicon glyphicon-th-list gray" data-view='list-book-block'></span> 
  </div>

<?php $this->widget('BookWidget', array('model'=>$this->subjectModel->textbook_book)); ?>



  
