<h1>Підручники <?php echo $this->param['clas'] . ' клас ' . $this->subjectModel->subject->title; ?></h1>

<div class="description">
  <?php echo $this->subjectModel->description; ?>
</div>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<div class="info">Виберіть підручник</div> 
 
<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>



  
