<h1>Підручники <?php echo $this->param['clas'] . ' клас ' . $this->subjectModel->subject->title; ?></h1>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<div class="info">Виберіть підручник</div> 
 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

<div class="description">
  <?php echo $this->subjectModel->description; ?>
</div>


  
