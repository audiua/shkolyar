<?php
/* @var $this GdzBookController */
/* @var $model GdzBook */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gdz-book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>"form-horizontal",
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		
		<div class="col-md-9 col-lg-9">
			<?php
			$this->widget('ImperaviRedactorWidget', array(
			    // You can either use it for model attribute
			    'model' => $model,
			    'attribute' => 'description',
				// 'selector' => '.col-md-10 col-lg-10',

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
			        'imageGetJson' => Yii::app()->createAbsoluteUrl('/ajax/writing/imageGetJson'),
			        'imageUpload' => Yii::app()->createAbsoluteUrl('/ajax/writing/imageUpload'),
			        'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/ajax/writing/imageUpload'),
			        'fileUpload' => Yii::app()->createAbsoluteUrl('/ajax/writing/fileUpload'),

			    ),
			)); 
			?>
		</div>
		
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="form-group">
			<?php echo $form->labelEx($model,'gdz_clas_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
			<?php echo $form->dropDownList($model,'gdz_clas_id', GdzClas::getAll(), array('class'=>'col-md-2 col-lg-2 control-label')); ?>
			<?php echo $form->error($model,'gdz_clas_id'); ?>
	</div>

	<div class="form-group">
			<?php echo $form->labelEx($model,'gdz_subject_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
			<?php echo $form->dropDownList($model,'gdz_subject_id', GdzClas::getAll(), array('class'=>'col-md-2 col-lg-2 control-label')); ?>
			<?php echo $form->error($model,'gdz_subject_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'img', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'img', array('gif'=>'gif', 'png'=>'png', 'jpg'=>'jpg', 'jpeg'=>'jpeg'), array('class'=>'control-label col-md-2 col-lg-2')); ?>
		<?php echo $form->error($model,'img'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'year', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'year',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'properties', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'properties',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'properties'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pagination', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'pagination',array('size'=>0,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'pagination'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'public_time', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<div class="col-md-9 col-lg-9">
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
		</div>
		
		<?php echo $form->error($model,'public_time'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'lang', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'lang', array('ua'=>'ua', 'ru'=>'ru'), array('class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'public', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'public', array(0=>'no', 1=>'yes'), array('class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'edition', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'edition',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'edition'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'info', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'info',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/gdzBook/index',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->