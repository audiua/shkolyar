<?php foreach( $model as $i => $one ): ?>

	<div class="col-md-1 col-sm-1 col-xs-2">
		<p class="task-number" data-url="<?php echo (int)$one; ?>" >
			<?php echo (int)$one; ?>
		</p>
	</div>

<?php endforeach; ?>	