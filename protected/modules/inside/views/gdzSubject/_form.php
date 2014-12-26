<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gdz-subject-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'gdz_clas_id'); ?>
		<?php echo $form->textField($model,'gdz_clas_id',array('size'=>10,'maxlength'=>10, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'gdz_clas_id'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'subject_id'); ?>
		<?php echo $form->textField($model,'subject_id',array('size'=>10,'maxlength'=>10, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'subject_id'); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->labelEx($model,'create_time'); ?>

		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'create_time',
		    'value'=>$model->create_time,
		    'htmlOptions' => array(
		    	'defaultDate'=>$model->create_time,
		        
		    ),
		));
		?>

		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->labelEx($model,'update_time'); ?>

		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'update_time',
		    'value'=>$model->update_time,
		    'htmlOptions' => array(
		    	'defaultDate'=>$model->update_time,
		        
		    ),
		));
		?>
		
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/gdzSubject/index',array('class'=>'btn btn-default')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->