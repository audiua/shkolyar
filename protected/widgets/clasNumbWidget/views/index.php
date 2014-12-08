<div class="clas-list">
<?php 
	$subjectField = $this->controller->id . '_subject';
	$count = count($model);
	foreach( $model as $i => $one ): 
		if($one->$subjectField):
			$url = $one->clas->slug;
			if(!empty($this->subject)){
				$url .= '/'.$this->subject;
			}
?>

	<div class="clas-number <?php echo $cl = ($count - 1) == $i ? 'last-clas-number' : '' ; ?> ">
		<h3><a class="clas-<?php echo $one->clas->slug; ?>" href="<?php echo '/'.$this->controller->id.'/'. $url ; ?>" title="ГДЗ <?php echo $one->clas->slug; ?> кдас"><?php echo $one->clas->slug; ?></a></h3>
	</div>

<?php endif;  endforeach; ?>
</div>