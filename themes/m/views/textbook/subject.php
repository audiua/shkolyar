<h1>Підручники <?php echo str_replace('-clas', '', $this->param['clas']) . ' клас ' . $this->subjectModel->name; ?></h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="info">Виберіть підручник</div> 
 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

<div class="description">
  <?php echo $this->subjectModel->description; ?>
</div>


  
