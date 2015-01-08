<div class="sidebar-menu">
	
	<!-- <div class="title-sidebar-menu">Категория</div> -->
	<ul class="sidebar-menu-category">
		
		<?php if($this->controller->id=='gdz'): ?>
			<li class='active'>
				<span class="active">ГДЗ</span>
			</li>
		<?php else : ?>
			<li>
			<?php echo CHtml::link( 'ГДЗ', array('/gdz'));  ?>
			</li>
		<?php endif; ?>

		<?php if($this->controller->id=='textbook'): ?>
			<li class='active'>
				<span class="active">Підручники</span>
			</li>
		<?php else : ?>
			<li>
			<?php echo CHtml::link( 'Підручники', array('/textbook'));  ?>
			</li>
		<?php endif; ?>


		<li>
			<?php echo CHtml::link( 'Всезнайка', array('/knowall'));  ?>
		</li>


	</ul>

	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Клас</div> -->
	<ul class="sidebar-menu-clas">
		<li class="<?php echo ($clas==0) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
				if($subject){
					$urlClas .='/'.$subject;
				} 

				if( $clas==0 ){
					echo '<span class="active">Всі класи</span>';
				} else {
					echo CHtml::link( 'Всі класи', array($urlClas)); 
				}
			?>
		</li>
		<?php foreach($this->controller->allClasModel as $oneClas): ?>

			<li class="<?php echo ($clas==$oneClas->clas->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlClas = '/'.$this->controller->id;
				if($subject){
					$urlClas .= '/'.$oneClas->clas->slug.'/'.$subject;
				} else  {
					$urlClas .= '/'.$oneClas->clas->slug;
				}

				if($clas==$oneClas->clas->slug){
					echo '<span class="active">'.$oneClas->clas->slug.'</span>';
				} else {
					echo CHtml::link( $oneClas->clas->slug, array($urlClas)); 
				} ?>
			</li>
			
		<?php endforeach; ?>
	</ul>
	
	<div class="clear"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">
		<li class="<?php echo ($subject=='') ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
				if($clas){
					$urlClas .='/'.$clas;
				} 

				if( $subject=='' ){
					echo '<span class="active">Всі предмети</span>';
				} else {
					echo CHtml::link( 'Всі предмети', array($urlClas)); 
				}
			?>
		</li>

		<?php foreach($allSubjectModel as $oneSubject): ?>
			<li class="<?php echo ($subject==$oneSubject->slug) ? 'active' : '' ; ?>">
				<?php 
				$urlSubject = '/'.$this->controller->id;
				if($clas){
					$urlSubject .= '/'.$clas;
				}

				$urlSubject .= '/'.$oneSubject->slug;

				if($subject==$oneSubject->slug){
					echo '<span class="active">'.$oneSubject->title.'</span>';
				} else {
					echo CHtml::link( $oneSubject->title, array($urlSubject)); 
				} ?>


			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>



</div>