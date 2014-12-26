<?php

// кoличество заданий в ряду
$countTaskInRow=12;

// счетчики
$k=0;

$active = '';
$color = '';

// определяем выбраное задание
if(isset($this->params['task'])){
	$taskActive = $this->params['task'];
} else {
	$taskActive = 0;
}

$tmp = array();
foreach( $model as $i => $one ){

	// если это массив, то нужно его отрисовать с вложеностью, добавляем его в временный массив
	if(is_array($one)){
		$tmp[$i]=$one;
		continue;
	}

	// определяем активное задание и добавляем ему класс active
	if((int)$one == $taskActive && !isset($this->params['section'])){

		// title страницы
		$this->controller->pageTitle .= ' завдання - '.(int)$one;

		// клас актив для выбраного задания
		$active = 'bold clas-active-'.$this->params['clas'];
		$color = 'clas-color-'.$this->params['clas'];
	}

	// отрисовка дива 
	if($k==0){
		echo '<div class="task-r">';
	}
	?>

	<div class="task-one task-one-<?php echo $this->params['clas']; ?>">
		<p class="task-number" data-url="<?php echo (int)$one; ?>" >
			<?php echo (int)$one; ?>
		</p>
	</div>


	<?php

	$k++;
	$active = '';
	$color = '';

	// закрываем див когда отрисовали 12 заданий
	if($k==$countTaskInRow){
		echo '</div>';
		$k=0;
	}

} //end foreach

// закрываем див, если он не закрыт (отрисовано меньше 12 заданий)
if($k != 0){
 	echo '</div>';
}

// если есть папки то вызываем виджет для отрисовки вложености
if(!empty($tmp)){
	$this->controller->widget('NestedWidget', array('model'=>$tmp));
}

?>


						
						