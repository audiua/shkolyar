<?php if( stripos(Yii::app()->request->hostInfo, 'shkolyar.loc') === false ): ?>
	<div class="<?php echo $this->model->name; ?> ref">
		<noindex>
			<?php echo $this->model->code; ?>
		</noindex>
	</div>
<?php else :?>
	<div class="ref">
		<?php echo $this->model->name; ?>
	</div> 
<?php endif; ?>