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
			$clas = str_replace('-clas', '',$one->clas->slug);
?>

	<div class="clas-number <?php echo $cl = ($count - 1) == $i ? 'last-clas-number' : '' ; ?> ">
		<h3><a class="clas-<?php echo $clas; ?>" href="<?php echo '/'.$this->controller->id.'/'. $url ; ?>" title="<?php echo $contr .' '. $one->clas->slug; ?> клас"><?php echo $clas; ?></a></h3>
	</div>

<?php 



endif;  endforeach; ?>
</div>