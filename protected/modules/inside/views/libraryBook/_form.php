<?php
/* @var $this LibraryBookController */
/* @var $model LibraryBook */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'library-book-form',
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
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'img_ext'); ?>
		<?php echo $form->textField($model,'img_ext',array('size'=>5,'maxlength'=>10, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'img_ext'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>10,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
		$this->widget('ImperaviRedactorWidget', array(
		    // You can either use it for model attribute
		    'model' => $model,
		    'attribute' => 'description',
			// 'selector' => '.redactor',

		    // or just for input field
		    // 'name' => 'Knowall_text',

		    // Some options, see http://imperavi.com/redactor/docs/
		    'options' => array(
		    	'buttons'=>array(
                    'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'video', 'link', '|', 'html',
                ),
		        'lang' => 'ru',
		        'toolbar' => true,
		        'iframe' => true,
		        'css' => 'wym.css',
		        'imageGetJson' => Yii::app()->createAbsoluteUrl('/ajax/library_author_id/imageGetJson'),
		        'imageUpload' => Yii::app()->createAbsoluteUrl('/ajax/library/imageUpload'),
		        'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/ajax/library/imageUpload'),
		        'fileUpload' => Yii::app()->createAbsoluteUrl('/ajax/library/fileUpload'),

		    ),
		)); 
		?>
		
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'library_author_id'); ?>
		<?php echo $form->textField($model,'library_author_id',array('size'=>10,'maxlength'=>10, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'library_author_id'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/subject/index',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->