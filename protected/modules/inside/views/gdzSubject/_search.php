<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="form-group col-lg-2">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="form-group col-lg-2">
		<?php echo $form->label($model,'gdz_clas_id'); ?>
		<?php echo $form->textField($model,'gdz_clas_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->label($model,'subject_id'); ?>
		<?php echo $form->textField($model,'subject_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->