<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">

		<li>
			<?= SeoHide::link("/gdz", 'ГДЗ'); ?>
		</li>

		<li>
			<?= SeoHide::link("/textbook", 'Підручники'); ?>
		</li>

		<li>
			<?= SeoHide::link("/knowall", 'Всезнайка'); ?>
		</li>

		<?php if($this->controller->id=='library'): ?>
			<li class='active'>
				<span class="active">Художня література</span>
			</li>
		<?php else : ?>
			<li>
			<?= SeoHide::link("/library", 'Художня література'); ?>
			</li>
		<?php endif; ?>

		<li>
			<?= SeoHide::link("/writing", 'Твори'); ?>
		</li>

	</ul>

	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">

		<li class="<?php echo (is_null($category)) ? 'active' : '' ; ?>">
			<?php 
				$url = '/'.$this->controller->id;

				if( is_null($category) ){
					echo '<span class="active">Всі автори</span>';
				} else {
					echo SeoHide::link($url, 'Всі автори');
					// echo CHtml::link( 'Всі автори', array($url)); 
				}
			?>
		</li>





		<?php foreach($categories as $one): ?>
			<li class="<?php echo ( ! is_null($category) && $category == $one->slug) ? 'active' : '' ; ?>">
				<?php 

				$url = '/'.$this->controller->id.'/'.$one->slug;
				
				if( ! is_null($category) && $category == $one->slug ){
					echo '<span class="active">'.$one->author.'</span>';
				} else {
					echo SeoHide::link($url, $one->author);
					// echo CHtml::link( $one->author, array($url)); 
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>

</div>