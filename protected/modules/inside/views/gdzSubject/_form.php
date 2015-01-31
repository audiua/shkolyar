<?php
/* @var $this GdzSubjectController */
/* @var $model GdzSubject */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gdz-subject-form',
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
			<?php echo $form->labelEx($model,'gdz_clas_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
			<?php echo $form->dropDownList($model,'gdz_clas_id', GdzClas::getAll(), array('class'=>'col-md-2 col-lg-2 control-label')); ?>
			<?php echo $form->error($model,'gdz_clas_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'subject_id', Subject::getAll(), array('class'=>'col-md-2 col-lg-2 control-label')); ?>
		<?php echo $form->error($model,'subject_id'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<div class="col-md-offset-9 col-lg-offset-9 col-md-2 col-lg-2">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success', )); ?>
			<?php echo CHtml::link('Вiдмiнити', '/inside/gdzSubject/index',array('class'=>'btn btn-default')); ?>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->