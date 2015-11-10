<h1>Твори <?php echo $this->subjectModel->title; ?></h1>

<div class="info">Виберіть клас</div>

<?php $this->widget('ClasNumbWritingCurrentSubjectWidget', array('subject'=>$this->subjectModel)); ?>
<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="description">
  <?php  echo $description; ?>
</div>