<h1><?php echo $this->h1; ?></h1>
<div class="description">
  <?php  echo $description; ?>
</div>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть клас для предмета <?php echo $subject->title ?> </div>

<?php $this->widget('ClasNumbCurrentSubjectWidget', array('subject'=>$subject)); ?>


<div class="clear"></div>
<div class="separator"></div>


<?php $this->widget('DataBookWidget', array('model'=>$books, 'params'=>array('subject'=>$subject->title))); ?>



  
