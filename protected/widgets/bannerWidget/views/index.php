<?php if( stripos(Yii::app()->request->hostInfo, 'shkolyar.loc') === false ): ?>
	<div class="<?php echo $this->model->name; ?> ref">
	<div class="separator"></div>
		<noindex>
			<?php echo $this->model->code; ?>
		</noindex>
	<div class="separator"></div>
	</div>
<?php else :?>
	<div class="ref">
		<?php echo $this->model->name; ?>
	</div> 
<?php endif; ?>