<div class="clas-list">
<?php 
	$subjectField = $this->controller->id . '_subject';
	$contr = ($this->controller->id=='gdz') ? 'ГДЗ' : 'Підручники' ;
	$count = count($model);
	foreach( $model as $i => $one ): 
		if($one->$subjectField):
			$url = $one->clas->slug;
			if(!empty($this->subject)){
				$url .= '/'.$this->subject;
			}
?>

	<div class="clas-number <?php echo $cl = ($count - 1) == $i ? 'last-clas-number' : '' ; ?> ">
		<h3><a class="clas-<?php echo $one->clas->slug; ?>" href="<?php echo '/'.$this->controller->id.'/'. $url ; ?>" title="<?php echo $contr .' '. $one->clas->slug; ?> клас"><?php echo $one->clas->slug; ?></a></h3>
	</div>

<?php endif;  endforeach; ?>
</div>