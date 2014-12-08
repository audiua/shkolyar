<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
?>

<?php echo $code; ?>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>