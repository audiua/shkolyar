<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">

		<li>
			<?php echo CHtml::link( 'ГДЗ', array('/gdz'));  ?>
		</li>

		<li>
			<?php echo CHtml::link( 'Підручники', array('/textbook'));  ?>
		</li>

		<?php if($this->controller->id=='knowall'): ?>
			<li class='active'>
				<span class="active">Всезнайка</span>
			</li>
		<?php else : ?>
			<li>
			<?php echo CHtml::link( 'Всезнайка', array('/knowall'));  ?>
			</li>
		<?php endif; ?>

	</ul>

	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">

		<li class="<?php echo (is_null($category)) ? 'active' : '' ; ?>">
			<?php 
				$url = '/'.$this->controller->id;

				if( is_null($category) ){
					echo '<span class="active">Всі категорії</span>';
				} else {
					echo CHtml::link( 'Всі категорії', array($url)); 
				}
			?>
		</li>





		<?php foreach($categories as $one): ?>
			<li class="<?php echo ( ! is_null($category) && $category == $one->slug) ? 'active' : '' ; ?>">
				<?php 

				$url = '/'.$this->controller->id.'/'.$one->slug;
				
				if( ! is_null($category) && $category == $one->slug ){
					echo '<span class="active">'.$one->title.'</span>';
				} else {
					echo CHtml::link( $one->title, array($url)); 
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>

</div>