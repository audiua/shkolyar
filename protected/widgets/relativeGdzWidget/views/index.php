<div class="relative-gdz">

<?php 
foreach( $model as $i => $one ):
	// книги закрыта для публикации
	if( ! $one->public){
		continue;
	}
	
	$path = 'img/gdz/'.$one->gdz_clas->clas->slug.'/'.$one->gdz_subject->subject->slug.'/'.$one->slug.'/book';
?>
	<div class="relative-gdz-block">

		<div class=""> 
		<?php 
			echo CHtml::image(
				Yii::app()->baseUrl . '/' . $path.'/'.$one->slug.'.'.$one->img, 'ГДЗ '. $one->gdz_clas->clas->slug .' клас '. $one->title . ' ' . $one->author, 
				array(
					'class'=>'img-small-book thumbnail ',
				)
			);
		?> 
		</div>
  		<div class="">
  			<div class="book-author"> <?php echo $one->author; ?></div>
  			<div class="book-subject"> <?php echo $one->title; ?></div>
  			<div class="book-clas"><?php echo $one->gdz_clas->clas->slug; ?> клас</div>
  			<?php 
  				if( !empty($one->properties) ){
  					echo '<div class="desc"><p>'.$one->properties.'<p></div>';
  				}
  			?>
  			<div class="desc">
  				<p><?php echo $one->description; ?></p>
  			</div>

  		</div>
		<div class="gdz-link">
			<?php echo CHtml::link( 'gdz', array('/gdz/'.$one->gdz_clas->clas->slug.'/'.$one->gdz_subject->subject->slug.'/'.$one->slug)); ?>
		</div>
		<div class="textbook-link">
			<?php echo CHtml::link( 'textbook', array('/textbook/'.$one->gdz_clas->clas->slug.'/'.$one->gdz_subject->subject->slug.'/'.$one->slug)); ?>
		</div>
					
	</div>
	<div class="clear"></div>
<?php
endforeach; ?>

</div>
