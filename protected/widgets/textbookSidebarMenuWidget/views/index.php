<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">
		

		<li>
		<?= SeoHide::link("/gdz", 'ГДЗ'); ?>
		</li>



		<li class='active'>
			<span class="active">Підручники</span>
		</li>


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
				$urlClas = '/textbook/';
				// if($subject){
				// 	$urlClas .='/'.$subject->slug;
				// } 

				// if( is_null($clas) ){
				// 	echo '<span class="active">Всі класи</span>';
				// } else {
				// 	echo SeoHide::link($urlClas, 'Всі класи');
				// 	// echo CHtml::link( 'Всі класи', array($urlClas)); 
				// }
				echo SeoHide::link($urlClas, 'Всі класи');
			?>
		</li>
		<?php 
		$subjectField = $this->controller->id . '_subject';
		$bookField = $this->controller->id . '_book';

		// классы
		foreach( TextbookClas::model()->findAll() as $oneClas ): 
			// if( ! $oneClas->$subjectField ){ 
			// 	continue; 
			// }

			// if(!is_null($subject)){
			// 	$flag = true;
			// 	foreach( $oneClas->$subjectField as $item ){

			// 		if($item->subject->slug == $subject->slug){
			// 			$flag = false;
			// 		}
			// 	}

			// 	if($flag){
			// 		continue;
			// 	}

			// }

			


			?>

			<li class="<?php echo ( !is_null($clas) && $clas->clas->slug == $oneClas->clas->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlClas = '/textbook';
				$shortCkas = str_replace('-clas', '', $oneClas->clas->slug);
				// if($subject){
				// 	$urlClas .= '/'.$oneClas->clas->slug.'/'.$subject->slug;
				// } else  {
				// 	$urlClas .= '/'.$oneClas->clas->slug;
				// }
				$urlClas .= '/'.$oneClas->clas->slug;

				if( !is_null($clas) && $clas->clas->slug == $oneClas->clas->slug){
					echo '<span class="active">'.$shortCkas.'</span>';
				} else {
					echo SeoHide::link($urlClas, $shortCkas);
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
			// if( ! $oneSubject->$field ){ 
			// 	continue; 
			// } 

			// $flag = true;
		 //    foreach($oneSubject->$field as $book){

		 //        // isset published book
		 //        if($book->public && $book->public_time < $time){
		 //            $flag = false;
		 //            break;
		 //        }
		 //    }
		    
		 //    if($flag){
		 //        continue;
		 //    }
			

			?>
			<li class="<?php echo ( ! is_null($subject) && $subject->slug == $oneSubject->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlSubject = '/'.$this->controller->id;
				if($clas){
					$urlSubject .= '/'.$clas->clas->slug;
				}

				$urlSubject .= '/'.$oneSubject->slug;

				if( ! is_null($subject) && $subject->slug == $oneSubject->slug ){
					echo '<span class="active">'.$oneSubject->name.'</span>';
				} else {
					echo SeoHide::link($urlSubject, $oneSubject->name);
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>



</div>