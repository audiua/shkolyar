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

		<li>
			<?= SeoHide::link("/library", 'Художня література'); ?>
		</li>

		<?php if($this->controller->id=='writing'): ?>
			<li class='active'>
				<span class="active">Твори</span>
			</li>
		<?php else : ?>
			<li>
			<?= SeoHide::link("/writing", 'Твори'); ?>
			</li>
		<?php endif; ?>

	</ul>

	<div class="clear"></div>




	<!-- <div class="title-sidebar-menu">Клас</div> -->
	<ul class="sidebar-menu-clas">
		<li class="<?php echo (is_null($clas)) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/writing';
				if($subject){
					$urlClas .='/'.$subject->slug;
				} 

				if( is_null($clas) ){
					echo '<span class="active">Всі класи</span>';
				} else {
					echo SeoHide::link($urlClas, 'Всі класи');
					// echo CHtml::link( 'Всі класи', array($urlClas)); 
				}
			?>
		</li>
		<?php 

		// классы
		foreach( $this->params['allClasModel'] as $oneClas ): 
			if( ! $oneClas->writing ){ 
				continue; 
			}

			if(!is_null($oneClas->writing)){
				$flag = true;
				foreach( $oneClas->writing as $item ){

					if($item->public){
						$flag = false;
					}
				}

				if($flag){
					continue;
				}

			}
		?>

		<li class="<?php echo ( !is_null($clas) && $clas->slug == $oneClas->slug) ? 'active' : '' ; ?>">
			<?php 
			$urlClas = '/writing';
			if($subject){
				$urlClas .= '/'.$oneClas->slug.'/'.$subject->slug;
			} else  {
				$urlClas .= '/'.$oneClas->slug;
			}

			if( !is_null($clas) && $clas->slug == $oneClas->slug){
				echo '<span class="active">'.$oneClas->slug.'</span>';
			} else {
				echo SeoHide::link($urlClas, $oneClas->slug);
				// echo CHtml::link( $oneClas->slug, array($urlClas)); 
			} ?>
		</li>
			
		<?php endforeach; ?>
	</ul>
	
	<div class="clear"></div>


	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">
		<li class="<?php echo (is_null($subject)) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/writing';
				if($clas){
					$urlClas .='/'.$clas->slug;
				} 

				if( is_null($subject) ){
					echo '<span class="active">Всі предмети</span>';
				} else {
					echo SeoHide::link($urlClas, 'Всі предмети');
					// echo CHtml::link( 'Всі предмети', array($urlClas)); 
				}
			?>
		</li>

		<?php 

		foreach($allSubjectModel as $oneSubject):
			if( ! $oneSubject->writing ){ 
				continue; 
			} 

			?>
			<li class="<?php echo ( ! is_null($subject) && $subject->slug == $oneSubject->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlSubject = '/writing';
				if($clas){
					$urlSubject .= '/'.$clas->slug;
				}

				$urlSubject .= '/'.$oneSubject->slug;

				if( ! is_null($subject) && $subject->slug == $oneSubject->slug ){
					echo '<span class="active">'.$oneSubject->title.'</span>';
				} else {
					echo SeoHide::link($urlSubject, $oneSubject->title);
					echo CHtml::link( $oneSubject->title, array($urlSubject)); 
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>




</div>