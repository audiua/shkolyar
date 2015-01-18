<div class="clas-list">
<?php 
	$count = count($model);
	foreach( $model as $i => $one ): 
		if(!$one->writing){
			continue;
		}
			
?>

	<div class="clas-number <?php echo $cl = ($count - 1) == $i ? 'last-clas-number' : '' ; ?> ">
		<h3><a class="clas-<?php echo $one->slug; ?>" href="<?php echo '/'.$this->controller->id.'/'. $one->slug ; ?>" title="Твори <?php echo $one->slug; ?> клас"><?php echo $one->slug; ?></a></h3>
	</div>

<?php endforeach; ?>
</div>