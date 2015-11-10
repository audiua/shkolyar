<?php 
$pageStr='';
if($page){$pageStr=' Cторінка '.$page;} ?>
<h1><?php echo $this->h1.$pageStr; ?></h1>


<div class="clear"></div>
<div class="separator"></div>


<div class="info">Збірники ГДЗ</div> 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

<?php if(!$page): ?>
<div class="description">
  <?php  echo $this->subjectModel->description; ?>
</div>
<?php endif; ?>



  
