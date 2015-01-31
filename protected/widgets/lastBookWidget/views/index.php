<div class="last-book">

<?php 
$first = true;
foreach( $model as $i => $one ):
	// книги закрыта для публикации
	if( ! $one->public){
		continue;
	}

	$mode_clas = $this->mode.'_clas';
	$mode_subject = $this->mode.'_subject';
	$btnSize = $first == true ? 'btn-sm' : 'btn-xs';
	
	$path = 'img/'.$this->mode.'/'.$one->$mode_clas->clas->slug.'/'.$one->$mode_subject->subject->slug.'/'.$one->slug.'/book';
?>
	<div class="last-book-block<?php echo ($first == true) ? '-first' : ''; ?>">

		<div class=""> 
		<?php 
			echo CHtml::image(
				Yii::app()->baseUrl . '/' . $path.'/'.$one->slug.'.'.$one->img, 'ГДЗ '. $one->$mode_clas->clas->slug .' клас '. $one->title . ' ' . $one->author, 
				array(
					'class'=>($first == true) ? 'thumbnail img-last-big-book' : 'thumbnail img-last-small-book',
				)
			);
		?> 
		</div>
  		<div class="">
  			<div class="book-author"> <?php echo $one->author; ?></div>
  			<div class="book-subject"> <?php echo $one->title; ?></div>
  			<div class="book-clas"><?php echo $one->$mode_clas->clas->slug; ?> клас</div>
  			<?php 
  				if( !empty($one->properties) ){
  					echo '<div class="desc"><p>'.$one->properties.'<p></div>';
  				}
  			?>

  		</div>
		<div class="gdz-link">
			<?php echo CHtml::link( 'Перейти' , array('/'.$this->mode.'/'.$one->$mode_clas->clas->slug.'/'.$one->$mode_subject->subject->slug.'/'.$one->slug), array('class'=>'btn btn-primary '.$btnSize)); ?>
		</div>
	</div>
<?php
$first = false;
endforeach; ?>
<div class="clear"></div>
</div>


