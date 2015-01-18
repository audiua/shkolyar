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
	'htmlOptions' => array(
        'class'=>"form-horizontal",
        // 'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class'=>'col-md-8 col-lg-8 control-label')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		
		<div class="col-md-8 col-lg-8">
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
			        'imageUpload' => Yii::app()->createAbsoluteUrl('/ajax/libraryBook/imageUpload'),
			        'clipboardUploadUrl' => Yii::app()->createAbsoluteUrl('/ajax/writing/imageUpload'),
			        'fileUpload' => Yii::app()->createAbsoluteUrl('/ajax/writing/fileUpload'),

			    ),
			)); 
			?>
		</div>
		
		<?php echo $form->error($model,'description'); ?>
	</div>

	



	<div class="form-group">
		<?php echo $form->labelEx($model,'img_ext', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'img_ext', array('gif'=>'gif', 'png'=>'png', 'jpg'=>'jpg', 'jpeg'=>'jpeg'), array('class'=>'control-label col-md-2 col-lg-2')); ?>
		<?php echo $form->error($model,'img_ext'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'slug',array('size'=>10,'maxlength'=>255, 'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<div class="col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-2">
			<?php echo CHtml::button('Перевести',array('class'=>'btn btn-default slug-translit')); ?>
		</div>	
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'library_author_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'library_author_id', LibraryAuthor::getAll(), array('class'=>'col-md-2 col-lg-2 control-label')); ?>
		
		<?php echo $form->error($model,'library_author_id'); ?>
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
		<?php echo $form->labelEx($model,'public', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->dropDownList($model,'public', array(0=>'no', 1=>'yes'), array('class'=>'col-md-4 col-lg-4 control-label')); ?>
		<?php echo $form->error($model,'public'); ?>
	</div>

	<div class="clear"></div>
	<div class="form-group">
		<div class="col-md-offset-8 col-lg-offset-8 col-md-2 col-lg-2">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success', )); ?>
			<?php echo CHtml::link('Вiдмiнити', '/inside/libraryBook/index',array('class'=>'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	
$('.slug-translit').click(function(){

    var slug = '';
    if( $('#LibraryBook_slug').val() ){
        slug = $('#LibraryBook_slug').val();
    }

    if(slug){
	    $.post('/ajax/LibraryBook/translit', {'slug':slug}, function(responce){
	        if(responce.success){
	        	console.log(responce);
	        	console.log($('#LibraryBook_slug'));
	        	console.log(responce.translit);
	            $('#LibraryBook_slug').val(responce.translit);
	            if( $('#LibraryBook_slug').hasClass('error') ){
	                $('#LibraryBook_slug').removeClass('error');
	                $('.slug_error').each(function(){
	                    $(this).remove();
	                });
	            }
	        } else {
	            $('#LibraryBook_slug').val(responce.translit);
	            $('.name_error').each(function(){
	                $(this).remove();
	            });
	            $('#LibraryBook_slug').after('<span class="help-inline error slug_error">' + responce.error + '</span>');
	            $('#LibraryBook_slug').addClass('error');
	        }
	    }, 'json');
    }

});


</script>