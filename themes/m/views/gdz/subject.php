<?php 
$pageStr='';
if($page){$pageStr=' Cторінка '.$page;} ?>
<h1><?php echo $this->h1.$pageStr; ?></h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="info">Збірники ГДЗ</div> 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

<?php if(!$page): ?>
<div class="description">
  <?php  echo $this->subjectModel->description; ?>
</div>
<?php endif; ?>



  
