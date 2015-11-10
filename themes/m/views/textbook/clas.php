<h1>Підручники <?php echo $this->param['clas'] . ' клас'; ?></h1>

<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWidget', array('model'=>$this->clasModel->textbook_subject)); ?>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<?php $this->widget('DataBookWidget', array('model'=>$books)); ?>

<div class="description">
  <?php echo $this->clasModel->description; ?>
</div>