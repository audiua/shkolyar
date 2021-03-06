<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">
		
		<?php if($this->controller->id=='gdz'): ?>
			<li class='active'>
				<span class="active">ГДЗ</span>
			</li>
		<?php else : ?>
			<li>
			<?= SeoHide::link("/gdz", 'ГДЗ'); ?>
			</li>
		<?php endif; ?>

		<?php if($this->controller->id=='textbook'): ?>
			<li class='active'>
				<span class="active">Підручники</span>
			</li>
		<?php else : ?>
			<li>
			<?= SeoHide::link("/textbook", 'Підручники'); ?>
			</li>
		<?php endif; ?>

		<li>
			<?= SeoHide::link("/knowall", 'Всезнайка'); ?>
		</li>

		<li>
			<?= SeoHide::link("/library", 'Художня література'); ?>
		</li>

		<li>
			<?= SeoHide::link("/writing", 'Твори'); ?>
		</li>
	</ul>

	<div class="clear"></div>




	<!-- <div class="title-sidebar-menu">Клас</div> -->
	<ul class="sidebar-menu-clas">
		<li class="<?php echo (is_null($clas)) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
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
		$subjectField = $this->controller->id . '_subject';
		$bookField = $this->controller->id . '_book';

		// классы
		foreach( $this->controller->allClasModel as $oneClas ): 
			if( ! $oneClas->$subjectField ){ 
				continue; 
			}

			if(!is_null($subject)){
				$flag = true;
				foreach( $oneClas->$subjectField as $item ){

					if($item->subject->slug == $subject->slug){
						$flag = false;
					}
				}

				if($flag){
					continue;
				}

			}

			


			?>

			<li class="<?php echo ( !is_null($clas) && $clas->clas->slug == $oneClas->clas->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlClas = '/'.$this->controller->id;
				if($subject){
					$urlClas .= '/'.$oneClas->clas->slug.'/'.$subject->slug;
				} else  {
					$urlClas .= '/'.$oneClas->clas->slug;
				}

				if( !is_null($clas) && $clas->clas->slug == $oneClas->clas->slug){
					echo '<span class="active">'.$oneClas->clas->slug.'</span>';
				} else {
					echo SeoHide::link($urlClas, $oneClas->clas->slug);
				} ?>
			</li>
			
		<?php endforeach; ?>
	</ul>
	
	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">
		<li class="<?php echo (is_null($subject)) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
				if($clas){
					$urlClas .='/'.$clas->clas->slug;
				} 

				if( is_null($subject) ){
					echo '<span class="active">Всі предмети</span>';
				} else {
					echo SeoHide::link($urlClas, 'Всі предмети');
				}
			?>
		</li>

		<?php 
		$time = time();
		$field= $this->controller->id.'_book';
		foreach($allSubjectModel as $oneSubject):
			if( ! $oneSubject->$field ){ 
				continue; 
			} 

			$flag = true;
		    foreach($oneSubject->$field as $book){

		        // isset published book
		        if($book->public && $book->public_time < $time){
		            $flag = false;
		            break;
		        }
		    }
		    
		    if($flag){
		        continue;
		    }
			

			?>
			<li class="<?php echo ( ! is_null($subject) && $subject->slug == $oneSubject->subject->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlSubject = '/'.$this->controller->id;
				if($clas){
					$urlSubject .= '/'.$clas->clas->slug;
				}

				$urlSubject .= '/'.$oneSubject->subject->slug;

				if( ! is_null($subject) && $subject->slug == $oneSubject->subject->slug ){
					echo '<span class="active">'.$oneSubject->subject->title.'</span>';
				} else {
					echo SeoHide::link($urlSubject, $oneSubject->subject->title);
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>



</div>