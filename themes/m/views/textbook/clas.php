<h1>Підручники <?php echo $this->param['clas'] . ' клас'; ?></h1>

<div class="description">
  <?php echo $this->clasModel->description; ?>
</div>
<div class="clear"></div>
<div class="separator"></div>


<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->textbook_subject)); ?>

<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'full-banner-content-middle'))); ?>

<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>