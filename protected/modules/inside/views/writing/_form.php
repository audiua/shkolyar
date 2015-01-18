<?php
/* @var $this WritingController */
/* @var $model Writing */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'writing-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class'=>"form-horizontal",
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'text', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<div class="col-md-9 col-lg-9">
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
	                    'html', 'html','formatting', '|', 'bold', 'italic', 'deleted', '|',
	                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
	                    'image', 'video', 'link'
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
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'clas_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'clas_id',Clas::getAll(), array('class'=>'col-md-6 col-lg-6 control-label'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'clas_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'subject_id',Subject::getAll(), array('class'=>'col-md-6 col-lg-6 control-label'),array('empty'=>'')); ?>
		<?php echo $form->error($model,'subject_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'public_time', array('class'=>"col-md-2 col-lg-2 control-label")); ?>

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

	<div class="form-group">
		<?php echo $form->labelEx($model,'public', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'public', array(0=>'no', 1=>'yes'), array('class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'col-md-6 col-lg-6 control-label')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255,'class'=>'col-md-6 col-lg-6 control-label')); ?>
		<div class="col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-2">
			<?php echo CHtml::button('Перевести',array('class'=>'btn btn-default slug-translit')); ?>
		</div>	

		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nausea', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'nausea', array('class'=>'col-md-6 col-lg-6 control-label')); ?>
		<?php echo $form->error($model,'nausea'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'thumbnail', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->fileField($model,'thumbnail', array('class'=>'col-md-3 col-lg-3 control-label')); ?>
		<?php echo $form->error($model,'thumbnail'); ?>
	</div>

	<?php if ($model->isNewRecord == false):?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'deleteImage', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
			<?php echo $form->checkBox($model,'deleteImage',array('class'=>'col-md-1 col-lg-1 control-label')); ?>
			<?php echo $form->error($model,'deleteImage'); ?>
			<img src="<?=$model->getThumb(100,100,'crop'); ?>" />
		</div>
	<?php endif;?>

	<div class="clear"></div>
	<div class="form-group">
		<div class="col-md-offset-9 col-lg-offset-9 col-md-2 col-lg-2">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success', )); ?>
			<?php echo CHtml::link('Вiдмiнити', '/inside/writing/index',array('class'=>'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	
$('.slug-translit').click(function(){

    var slug = '';
    if( $('#Writing_slug').val() ){
        slug = $('#Writing_slug').val();
    }

    if(slug){
	    $.post('/ajax/writing/translit', {'slug':slug}, function(responce){
	        if(responce.success){
	        	console.log(responce);
	        	console.log($('#Writing_slug'));
	        	console.log(responce.translit);
	            $('#Writing_slug').val(responce.translit);
	            if( $('#Writing_slug').hasClass('error') ){
	                $('#Writing_slug').removeClass('error');
	                $('.slug_error').each(function(){
	                    $(this).remove();
	                });
	            }
	        } else {
	            $('#Writing_slug').val(responce.translit);
	            $('.name_error').each(function(){
	                $(this).remove();
	            });
	            $('#Writing_slug').after('<span class="help-inline error slug_error">' + responce.error + '</span>');
	            $('#Writing_slug').addClass('error');
	        }
	    }, 'json');
    }

});



// var clas = $( "#TextbookBook_textbook_clas_id :selected").val();
// if(clas){	
// 	$.post('/ajax/textbookBook/subject', {'clas':clas}, function(responce){
// 	    if(responce){
// 	    	console.log(responce);
// 	    	$( "#TextbookBook_textbook_subject_id" ).html(responce)
// 	    }
// 	}, 'html');
// }

</script>