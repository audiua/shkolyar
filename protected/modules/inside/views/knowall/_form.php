<?php
/* @var $this KnowallController */
/* @var $model Knowall */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
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
		<?php
		$this->widget('ImperaviRedactorWidget', array(
		    // You can either use it for model attribute
		    'model' => $model,
		    'attribute' => 'text',
			// 'selector' => '.redactor',

		    // or just for input field
		    // 'name' => 'Knowall_text',

		    // Some options, see http://imperavi.com/redactor/docs/
		    'options' => array(
		    	'buttons'=>array(
                    'html','html','formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'video', 'link', '|'
                ),
		        'lang' => 'ru',
		        'toolbar' => true,
		        'iframe' => true,
		        'css' => 'wym.css',
		        'imageGetJson' => Yii::app()->createAbsoluteUrl('/ajax/default/imageGetJson'),
		        'imageUpload' => Yii::app()->createAbsoluteUrl('/ajax/default/imageUpload'),
		        'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/ajax/default/imageUpload'),
		        'fileUpload' => Yii::app()->createAbsoluteUrl('/ajax/default/fileUpload'),

		    ),
		)); 
		?>
		
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

	<div class="form-group">
		<?php echo $form->labelEx($model,'nausea'); ?>
		<?php echo $form->textField($model,'nausea'); ?>
		<?php echo $form->error($model,'nausea'); ?>
	</div>

	<?php if ($model->isNewRecord == false):?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'deleteImage'); ?>
			<?php echo $form->checkBox($model,'deleteImage'); ?>
			<?php echo $form->error($model,'deleteImage'); ?>
			<img src="<?=$model->getThumb(100,100,'crop'); ?>" />
		</div>
	<?php endif;?>

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
		    'mode' => 'datetime',
		    'value'=>$model->public_time,
		    'htmlOptions' => array(
		    	'defaultDate'=>$model->public_time,
		        
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

