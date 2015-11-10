<h1><?php echo $this->h1; ?></h1>

<div class="description">
  <?php  echo $description; ?>
</div>

<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>