<h1><?php echo $this->h1; ?></h1>

<div class="info">Виберіть клас для предмета <?php echo $subject->title ?> </div>

<?php $this->widget('ClasNumbCurrentSubjectWidget', array('subject'=>$subject)); ?>
<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<?php $this->widget('DataBookWidget', array('model'=>$books, 'params'=>array('subject'=>$subject->title))); ?>

<div class="description">
  <?php  echo $description; ?>
</div>


  
