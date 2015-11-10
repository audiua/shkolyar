<?php 
$pageStr='';
if($page){$pageStr=' Cторінка '.$page;} ?>
<h1><?php echo $this->h1 . $pageStr; ?></h1>


  
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть предмет для <?php  echo $this->clasModel->clas->slug; ?> класу</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->gdz_subject)); ?>

<div class="clear"></div>
<div class="separator"></div>



<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

  
<div class="clear"></div>
<div class="separator"></div>

<?php if(!$page): ?>
<div class="description">
  <?php  echo $this->clasModel->description; ?>
</div>
<?php endif; ?>