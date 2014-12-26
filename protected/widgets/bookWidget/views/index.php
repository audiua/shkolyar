<div class="book-list">
<?php 
// print_r($this->model);
// die;
$time = time();
$categoryClas = $this->controller->id . '_clas';
$categorySubject = $this->controller->id . '_subject';
foreach( $this->model as $i => $one ):

	// только книги с прошлой датой
	if( $one->create_time > $time ){
		continue;
	}

	// ping google
	// 
	// if(!$one->ping){
	// 	$url = Yii::app()->request->hostInfo . '/' . $this->params['clas'].'/'.$this->params['subject'].'/'.$one->slug;
	// 	$ping = new GooglePing();
	// 	$ping->pingUrl( $url );
	// }

	// книги закрыта для публикации
	if( ! $one->public){
		continue;
	}

	// if( !isset($this->params['book'])){
	// 	$this->params['book'] = '';
	// 	// echo $this->controller->book;
	// 	// die;
	// } else {

	// 	// if($one->slug === $one->gdz_clas->clas->slug $this->params['book'] && !$this->one ){
	// 	// 	$this->controller->pageTitle .= ' '.$one->author;
	// 	// }
	// }


	$path = 'img/'.$this->controller->id.'/'.$one->$categoryClas->clas->slug.'/'.$one->$categorySubject->subject->slug.'/'.$one->slug.'/book';

	// if( ! file_exists( $_SERVER['DOCUMENT_ROOT'] . $path ) ){
	// 	continue;
	// 	throw new CHttpException('404', 'нету директории учебника ' .$_SERVER['DOCUMENT_ROOT'] . $path);
	// }

	// if( ! file_exists($_SERVER['DOCUMENT_ROOT'] . $path.'/'.$one->img ) ){
	// 	throw new CHttpException('404', '1  нет изображения учебника'.$_SERVER['DOCUMENT_ROOT'] . $path.'/'.$one->img);
	// }

?>



	<div class="middle-book-block">

		<div class=""> 
		<?php 
			echo CHtml::image(
				Yii::app()->baseUrl . '/' . $path.'/'.$one->slug.'.'.$one->img, 'ГДЗ '. $one->$categoryClas->clas->slug .' клас '. $one->title . ' ' . $one->author, 
				array(
					'class'=>'img-middle-book thumbnail ',
				)
			);
		?> 
		</div>
  		<div class="">
  			<div class="book-author"> <?php echo $one->author; ?></div>
  			<div class="book-subject"> <?php echo $one->title; ?></div>
  			<div class="book-clas"><?php echo $one->$categoryClas->clas->slug; ?> клас</div>
  			<?php 
  				if( !empty($one->properties) ){
  					echo '<div class="desc">'.$one->properties.'</div>';
  				}
  			?>
  			<div class="desc">
  				<p><?php echo $one->description; ?></p>
  			</div>

  		</div>
			
			<?php  

				if( $this->controller->id == 'gdz' ): ?>

					<div class="gdz-link">
						<?php echo CHtml::link( 'Перейти до збірника ГДЗ', array('/gdz/'.$one->$categoryClas->clas->slug.'/'.$one->$categorySubject->subject->slug.'/'.$one->slug), array('class'=>'btn btn-primary btn-lg')); ?>
					</div>


					<?php 
					// print_r( $this->controller->checkerBook($one->$categoryClas->clas->slug, $one->$categorySubject->subject->slug, $one->slug) );
					// die;
					if( $this->controller->checkerBook($one->$categoryClas->clas->slug, $one->$categorySubject->subject->slug, $one->slug) ):?>
						<div class="textbook-link">
							<?php echo CHtml::link( 'Перейти до підручника онлайн', array('/textbook/'.$one->$categoryClas->clas->slug.'/'.$one->$categorySubject->subject->slug.'/'.$one->slug), array('class'=>'btn btn-success btn-lg')); ?>
						</div>
					<?php endif;
					

				else : ?>

				<div class="textbook-link">
					<?php echo CHtml::link( 'textbook', array('/textbook/'.$one->$categoryClas->clas->slug.'/'.$one->$categorySubject->subject->slug.'/'.$one->slug)); ?>
				</div>
				
				<?php 

					

					if( $this->controller->checkerBook($one->$categoryClas->clas->slug, $one->$categorySubject->subject->slug, $one->slug) ):?>
						<div class="textbook-link">
							<?php echo CHtml::link( 'gdz', array('/gdz/'.$one->$categoryClas->clas->slug.'/'.$one->$categorySubject->subject->slug.'/'.$one->slug)); ?>
						</div>
					<?php endif; ?>

				
			<?php endif;  ?>
			
					
	</div>
<?php
endforeach; ?>

</div>