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

	</ul>

	<div class="clear"></div>
	<div class="separator"></div>

	<!-- <div class="title-sidebar-menu">Клас</div> -->
	<ul class="sidebar-menu-clas">
		<li class="<?php echo ($clas==0) ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
				if($subject){
					$urlClas .='/'.$subject;
				} 
				echo CHtml::link( 'Всі класи', array($urlClas)); 
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
				echo CHtml::link( $oneClas->clas->slug, array($urlClas)); ?>
			</li>
			
		<?php endforeach; ?>
	</ul>
	
	<div class="clear"></div>
	<div class="separator"></div>

	<!-- <div class="title-sidebar-menu">Предмет</div> -->
	<ul class="sidebar-menu-subject">
		<li class="<?php echo ($subject=='') ? 'active' : '' ; ?>">
			<?php 
				$urlClas = '/'.$this->controller->id;
				if($clas){
					$urlClas .='/'.$clas;
				} 
				echo CHtml::link( 'Всі предмети', array($urlClas)); 
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

				echo CHtml::link( $oneSubject->title, array($urlSubject)); ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>



</div>