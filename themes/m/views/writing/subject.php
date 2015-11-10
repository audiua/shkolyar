<h1><?php echo $this->h1; ?></h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>
<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="description">
  <?php  echo $description; ?>
</div>