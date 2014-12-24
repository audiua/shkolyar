<?php
/* @var $this KnowallController */
/* @var $model Knowall */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowall-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>8, 'cols'=>50, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'thumbnail'); ?>
		<?php echo $form->fileField($model,'thumbnail'); ?>
		<?php echo $form->error($model,'thumbnail'); ?>
	</div>

	<div class="form-group col-lg-2">
		<?php echo $form->labelEx($model,'knowall_category_id'); ?>
		<?php echo $form->dropDownList($model,'knowall_category_id',KnowallCategory::getAll(), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'knowall_category_id'); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->labelEx($model,'public_time'); ?>

		<?php
		$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
		    'model' => $model,
		    'attribute' => 'public_time',
		    'mode' => 'date',
		    'value'=>$model->public_time,
		    'htmlOptions' => array(
		    	'defaultDate'=>date('dd.mm.yyyy',$model->public_time),
		        
		    ),
		));
		?>
		
		<?php echo $form->error($model,'public_time'); ?>
	</div>

	<div class="form-group col-lg-1">
		<?php echo $form->labelEx($model,'public'); ?>
		<?php echo $form->dropDownList($model,'public', array(0=>'no', 1=>'yes'), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/knowall/index',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->