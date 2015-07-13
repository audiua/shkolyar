<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">

		<li>
			<?= SeoHide::link("/gdz", 'ГДЗ'); ?>
		</li>

		<li>
			<?= SeoHide::link("/textbook", 'Підручники'); ?>
		</li>

		<?php if($this->controller->id=='knowall'): ?>
			<li class='active'>
				<span class="active">Всезнайка</span>
			</li>
		<?php else : ?>
			<li>
			<?= SeoHide::link("/knowall", 'Всезнайка'); ?>
			</li>
		<?php endif; ?>

		<li>
			<?= SeoHide::link("/library", 'Художня література'); ?>
		</li>

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
					echo '<span class="active">Всі категорії</span>';
				} else {
					echo SeoHide::link($url, 'Всі категорії');
					// echo CHtml::link( 'Всі категорії', array($url)); 
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
					echo SeoHide::link($url, $one->title);
					// echo CHtml::link( $one->title, array($url)); 
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>

</div>