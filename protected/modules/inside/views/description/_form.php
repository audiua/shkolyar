<?php
/* @var $this DescriptionController */
/* @var $model Description */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'description-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->dropDownList($model,'owner',Helper::getOwner(), array('class'=>'form-control'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'owner'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->dropDownList($model,'action',Helper::getAction(), array('class'=>'form-control'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'clas_id'); ?>
		<?php echo $form->dropDownList($model,'clas_id',Clas::getAll(), array('class'=>'form-control'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'clas_id'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'subject_id'); ?>
		<?php echo $form->dropDownList($model,'subject_id',Subject::getAll(), array('class'=>'form-control'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'subject_id'); ?>
	</div>

	<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
		$this->widget('ImperaviRedactorWidget', array(
		    // You can either use it for model attribute
		    'model' => $model,
		    'attribute' => 'description',

			// 'selector' => '#redactor',

		    // or just for input field
		    // 'name' => 'Knowall_text',

		    // Some options, see http://imperavi.com/redactor/docs/
		    'options' => array(
		    	'buttons'=>array(
                    'html','html', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'link'
                ),
          //       'pastePlainText' => true,
		        // 'lang' => 'ru',
		        // 'toolbar' => true,
		        // 'iframe' => true,
		        // 'css' => 'wym.css',
		        'imageGetJson' => Yii::app()->createAbsoluteUrl('/ajax/description/imageGetJson'),
		        'imageUpload' => Yii::app()->createAbsoluteUrl('/ajax/description/imageUpload'),
		        // 'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/ajax/description/imageUpload'),
		        // 'fileUpload' => Yii::app()->createAbsoluteUrl('/ajax/description/fileUpload'),

		    ),
		    'plugins' => array(
                'fullscreen' => array(
                    'js' => array('fullscreen.js',),
                ),
                // 'clips' => array(
                //     'baseUrl' => '/js/my_plugin',
                //     'css' => array('clips.css',),
                //     'js' => array('clips.js',),
                //     'depends' => array('imperavi-redactor',),
                // ),
                'fontcolor'=>array(
                    'js'=>array('fontcolor.js'),
                ),
                'fontsize'=>array(
                    'js'=>array('fontsize.js'),
                ),
                'table'=>array(
                    'js'=>array('table.js'),
                ),
                'textdirection'=>array(
                    'js'=>array('textdirection.js'),
                ),
               	
            ),
		)); 
		?>
		
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link('Вiдмiнити', '/inside/gdzBook/index',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

