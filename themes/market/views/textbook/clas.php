

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
   <!--  <div class="navbar-header">
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
</div>

<h1>Пидручники <?php echo $this->param['clas'] . ' клас'; ?></h1>
<p class="description">
<?php echo $this->clasModel->description; ?><br><br>
  
</p>
<div class="separator"></div>
<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->textbook_subject)); ?>
<!-- <div class="subject-list">
  <div class="subject">
    <h3><a class="clas-5" href="/gdz/5/math">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-6" href="/gdz/6">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-7" href="/gdz/7">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-8" href="/gdz/8">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-9" href="/gdz/9">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-10" href="/gdz/10">математика</a></h3>
  </div>
  <div class="subject">
    <h3><a class="clas-11" href="/gdz/11">математика</a></h3>
  </div>
</div> -->
<div class="clear"></div>
<div class="separator"></div>