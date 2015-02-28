

<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
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

<h1>Підручники <?php echo $this->param['clas'] . ' клас'; ?></h1>

<div class="description">
  <?php echo $this->clasModel->description; ?>
</div>
<?php $this->widget('LikeWidget'); ?>
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


<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->textbook_subject)); ?>

<div class="clear"></div>
<div class="separator"></div>
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>