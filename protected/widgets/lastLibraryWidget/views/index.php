<div class="last-knowall">
<?php $first = array_shift($model); 
	$imgPath = '/img/library/'.$first->library_author->slug.'/'.$first->slug.'/book/first.'.$first->img_ext;
?>
<div class="knowall-large-block">
	<?php 
	echo SeoHide::link('/library/'.$first->library_author->slug . '/'. $first->slug, CHtml::image($imgPath,$first->title, array('class'=>'img-350x280')));

	// echo CHtml::image($imgPath,$first->title, array('title'=>$first->title, 'class'=>'img-350x280')); 
	?>
	<div class="knowall-link">
		<?php echo CHtml::link($first->title,'/library/'.$first->library_author->slug . '/'. $first->slug,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php // echo SeoHide::link('/library/'.$first->library_author->slug, Helper::getShortAuthor($first->library_author->author))?>
			<?php // echo CHtml::link( Helper::getShortAuthor($first->library_author->author),'/library/'.$first->library_author->slug ,array('class'=>'')); ?>
			<?php echo CHtml::link( $first->library_author->author, '/library/'.$first->library_author->slug ,array('class'=>'')); ?>
	</div>
</div>

<div class="knowall-small-block">
<?php foreach( $model as $i => $one ): 
	$imgPath = '/img/library/'.$one->library_author->slug.'/'.$one->slug.'/book/first.'.$one->img_ext;
?>

	<div class='knowall-small-one-block'>
		<?php 

		echo SeoHide::link('/library/'.$one->library_author->slug . '/'. $one->slug, CHtml::image($imgPath,$one->title, array('class'=>'img-150x106')));
		// echo CHtml::image($imgPath,$one->title, array('title'=>$one->title, 'class'=>'img-150x106')); 
		?>
		
		<div class="knowall-link">
			<?php echo CHtml::link($one->title,'/library/'.$one->library_author->slug . '/'. $one->slug,array('class'=>'')); ?>
		</div>

		<div class="knowall-category-link">
			<?php // echo SeoHide::link('/library/'.$first->library_author->slug, Helper::getShortAuthor($first->library_author->author))?>
			<?php // echo CHtml::link( Helper::getShortAuthor($one->library_author->author),'/library/'.$one->library_author->slug ,array('class'=>'')); ?>
			<?php echo CHtml::link( $one->library_author->author,'/library/'.$one->library_author->slug ,array('class'=>'')); ?>
			
		</div>

	</div>
	<!-- <div class="clear"></div> -->

<?php endforeach; ?>
</div>
<div class="clear"></div>
</div>


