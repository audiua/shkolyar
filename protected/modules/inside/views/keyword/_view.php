<?php
/* @var $this KeywordController */
/* @var $data Keyword */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyword')); ?>:</b>
	<?php echo CHtml::encode($data->keyword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('g_view')); ?>:</b>
	<?php echo CHtml::encode($data->g_view); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('y_view')); ?>:</b>
	<?php echo CHtml::encode($data->y_view); ?>
	<br />


</div>