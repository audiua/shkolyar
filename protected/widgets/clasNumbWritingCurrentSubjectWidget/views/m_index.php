<div class="row">
<?php 
	$count = count($model);
	foreach( $model as $i => $one ): 
		if(!$one->writing){
			continue;
		}
			
?>

	<div class="col-md-3 col-sm-3 col-xs-4">
		<h3><a class="clas-<?php echo $one->slug; ?>" href="/<?php echo $this->mode; ?>/<?php echo $one->slug.'/'.$this->subject->slug ; ?>" title="ГДЗ <?php echo $one->slug .' клас '. $this->subject->title ; ?> "><?php echo $one->slug; ?></a></h3>
	</div>

<?php endforeach; ?>
</div>