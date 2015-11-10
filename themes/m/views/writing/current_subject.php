<h1>Твори <?php echo $this->subjectModel->title; ?></h1>

<div class="description">
  <?php  echo $description; ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть клас</div>

<?php $this->widget('ClasNumbWritingCurrentSubjectWidget', array('subject'=>$this->subjectModel)); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>