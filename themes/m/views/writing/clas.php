<h1><?php echo $this->h1; ?></h1>

<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWritingWidget', array('model'=>Subject::model()->findAll())); ?>
<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>
<div class="description">
  <?php  echo $description; ?>
</div>