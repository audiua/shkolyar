<div class="last-knowall">
<?php $first = array_shift($model); 
	$imgPath = '/img/library/'.$first->library_author->slug.'/'.$first->slug.'/book/first.png';
?>
<div class="knowall-large-block">
	<?php echo CHtml::image($imgPath,'aaa', array('title'=>'ssss', 'class'=>'img-350x280')); ?>
	<div class="knowall-link">
		<?php echo CHtml::link($first->title,'/library/'.$first->library_author->slug . '/'. $first->slug,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php echo CHtml::link( Helper::getShortAuthor($first->library_author->author),'/library/'.$first->library_author->slug ,array('class'=>'')); ?>
	</div>
</div>

<div class="knowall-small-block">
<?php foreach( $model as $i => $one ): ?>

	<div class='knowall-small-one-block'>
		<?php echo CHtml::image($imgPath,'aaa', array('title'=>'ssss', 'class'=>'img-150x106')); ?>
		
		<div class="knowall-link">
			<?php echo CHtml::link($one->title,'/library/'.$one->library_author->slug . '/'. $one->slug,array('class'=>'')); ?>
		</div>

		<div class="knowall-category-link">
			<?php echo CHtml::link( Helper::getShortAuthor($one->library_author->author),'/library/'.$one->library_author->slug ,array('class'=>'')); ?>
		</div>

	</div>
	<!-- <div class="clear"></div> -->

<?php endforeach; ?>
</div>
<div class="clear"></div>
</div>


