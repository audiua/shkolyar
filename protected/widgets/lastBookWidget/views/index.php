<div class="last-book">

<?php 
$first = true;
$controller = ($this->mode=='gdz') ? 'ГДЗ ':'Підручник ';
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

			echo SeoHide::link('/'.$this->mode.'/'.$one->$mode_clas->clas->slug.'/'.$one->$mode_subject->subject->slug.'/'.$one->slug, CHtml::image( ($first == true) ? $one->getThumb(160,245,'resize') : $one->getThumb(100,135,'resize')
				, $controller . $one->$mode_clas->clas->slug .' клас '. $one->title . ' ' . $one->author, 
				array(
					'class'=>($first == true) ? 'thumbnail img-last-big-book' : 'thumbnail img-last-small-book',
					'title'=> $controller . $one->$mode_clas->clas->slug .' клас '. $one->title . ' ' . $one->author,
				)
			));
			//Yii::app()->baseUrl . '/' . $path.'/'.$one->slug.'.'.$one->img
			
		?> 
		</div>
  		<div class="">
  			<?php echo CHtml::link('
  			<div class="book-author">'.$one->author.'</div>
  			<div class="book-subject">'.$one->title.'</div>
  			<div class="book-clas">'.$one->$mode_clas->clas->slug.'клас</div>', array('/'.$this->mode.'/'.$one->$mode_clas->clas->slug.'/'.$one->$mode_subject->subject->slug.'/'.$one->slug)
  			); ?>
  			<?php 
  				if( !empty($one->properties) ){
  					echo '<div class="desc"><p>'.$one->properties.'<p></div>';
  				}
  			?>

  		</div>
		
	</div>
<?php
$first = false;
endforeach; ?>
<div class="clear"></div>
</div>




