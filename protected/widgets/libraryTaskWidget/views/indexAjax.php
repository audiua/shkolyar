<?php

// кoличество заданий в ряду
$countTaskInRow=12;

// счетчики
$k=0;

foreach( $model as $i => $one ){

	// отрисовка дива 
	if($k==0){
		echo '<div class="task-r">';
	}
	?>

	<div class="task-one">
		<p class="task-number" data-url="<?php echo (int)$one; ?>" >
			<?php echo (int)$one; ?>
		</p>
	</div>


	<?php

	$k++;
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


?>


						
						