<?php
/* @var $this GdzBookController */
/* @var $model GdzBook */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gdz-book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="form-group col-lg-2">
		<?php echo $form->labelEx($model,'gdz_clas_id'); ?>
		<?php echo $form->dropDownList($model,'gdz_clas_id',GdzClas::getAll(), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'gdz_clas_id'); ?>
	</div>

	<div class="form-group col-lg-2">
		<?php echo $form->labelEx($model,'gdz_subject_id'); ?>
		<?php echo $form->dropDownList($model,'gdz_subject_id', GdzSubject::getAll(), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'gdz_subject_id'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="form-group col-lg-1">
		<?php echo $form->labelEx($model,'img'); ?>
		<?php echo $form->dropDownList($model,'img', array('gif'=>'gif', 'png'=>'png', 'jpg'=>'jpg', 'jpeg'=>'jpeg'), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'img'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'properties'); ?>
		<?php echo $form->textField($model,'properties',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'properties'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'pagination'); ?>
		<?php echo $form->textField($model,'pagination',array('size'=>0,'maxlength'=>0)); ?>
		<?php echo $form->error($model,'pagination'); ?>
	</div>

	<div class="form-group col-lg-3">
		<?php echo $form->labelEx($model,'public_time'); ?>

		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'public_time',
		    'value'=>$model->public_time,
		    'htmlOptions' => array(
		    	'defaultDate'=>$model->public_time,
		        
		    ),
		));
		?>
		
		<?php echo $form->error($model,'public_time'); ?>
	</div>

	<div class="form-group col-lg-1">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->dropDownList($model,'lang', array('ua'=>'ua', 'ru'=>'ru'), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="form-group col-lg-1">
		<?php echo $form->labelEx($model,'public'); ?>
		<?php echo $form->dropDownList($model,'public', array(0=>'no', 1=>'yes'), array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'edition'); ?>
		<?php echo $form->textField($model,'edition',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'edition'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/gdzBook/index',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->