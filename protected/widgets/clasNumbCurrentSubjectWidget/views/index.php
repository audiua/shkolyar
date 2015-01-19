<div class="clas-list">
<?php 
	$count = count($model);
	foreach( $model as $i => $one ): ?>

	<div class="clas-number <?php echo $cl = ($count - 1) == $i ? 'last-clas-number' : '' ; ?>">
		<h3><a class="clas-<?php echo $one->clas->slug; ?>" href="/<?php echo $this->mode; ?>/<?php echo $one->clas->slug.'/'.$this->subject->slug ; ?>" title="ГДЗ <?php echo $one->clas->slug .' клас '. $this->subject->title ; ?> "><?php echo $one->clas->slug; ?></a></h3>
	</div>

<?php endforeach; ?>
</div>