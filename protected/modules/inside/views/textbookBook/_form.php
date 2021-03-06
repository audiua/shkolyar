<?php
/* @var $this TextbookBookController */
/* @var $model TextbookBook */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'textbook-book-form',
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

		<?php echo $form->labelEx($model,'textbook_clas_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php 
		echo CHtml::dropDownList('TextbookBook_textbook_clas_id',$model->textbook_clas_id, 
		  TextbookClas::getAll(),
		  array(
		    // 'prompt'=>'Select Region',
		    'class'=>'col-md-2 col-lg-2 control-label',
		    'ajax' => array(
		    'type'=>'POST', 
		    'url'=>Yii::app()->createUrl('/ajax/textbookBook/subject'), 
		    'update'=>'#TextbookBook_textbook_subject_id', 
		    'data'=>array('clas'=>'js:this.value'),
		  )));  ?>

		<?php echo $form->error($model,'textbook_clas_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'textbook_subject_id', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php 
		$clas = empty($model->textbook_clas_id) ? 1 : $model->textbook_clas_id;
		echo $form->dropDownList($model,'textbook_subject_id', TextbookSubject::getAll($clas), array('class'=>'col-md-2 col-lg-2 control-label ')); ?>
		<?php echo $form->error($model,'textbook_subject_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug', array('class'=>"col-md-2 col-lg-2 control-label")); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255,'class'=>'col-md-4 col-lg-4 control-label')); ?>
		<div class="col-md-offset-1 col-lg-offset-1 col-md-2 col-lg-2">
			<?php echo CHtml::button('Перевести',array('class'=>'btn btn-default slug-translit')); ?>
		</div>	
	
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
		<div class="col-md-offset-9 col-lg-offset-9 col-md-2 col-lg-2">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Обновити',array('class'=>'btn btn-success', )); ?>
			<?php echo CHtml::link('Вiдмiнити', '/inside/textbookBook/index',array('class'=>'btn btn-default')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	
$('.slug-translit').click(function(){

    var slug = '';
    if( $('#TextbookBook_slug').val() ){
        slug = $('#TextbookBook_slug').val();
    }

    if(slug){
	    $.post('/ajax/textbookBook/translit', {'slug':slug}, function(responce){
	        if(responce.success){
	        	console.log(responce);
	        	console.log($('#TextbookBook_slug'));
	        	console.log(responce.translit);
	            $('#TextbookBook_slug').val(responce.translit);
	            if( $('#TextbookBook_slug').hasClass('error') ){
	                $('#TextbookBook_slug').removeClass('error');
	                $('.slug_error').each(function(){
	                    $(this).remove();
	                });
	            }
	        } else {
	            $('#TextbookBook_slug').val(responce.translit);
	            $('.name_error').each(function(){
	                $(this).remove();
	            });
	            $('#TextbookBook_slug').after('<span class="help-inline error slug_error">' + responce.error + '</span>');
	            $('#TextbookBook_slug').addClass('error');
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