<div class="last-knowall">
<?php $first = array_shift($model); ?>
<div class="knowall-large-block">
	<?php 
	echo SeoHide::link('/knowall/'.$first->knowall_category->slug . '/'. $first->slug, CHtml::image($first->getThumb(350,280,'crop'),$first->title, array('class'=>'')));
	// echo CHtml::image($first->getThumb(350,280,'crop'),$first->title, array('title'=>$first->title, 'class'=>'')); 
	?>
	<div class="knowall-link">
		<?php echo CHtml::link($first->title,'/knowall/'.$first->knowall_category->slug . '/'. $first->slug,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php echo CHtml::link($first->knowall_category->title,'/knowall/'.$first->knowall_category->slug ,array('class'=>'')); ?>
	</div>
</div>

<div class="knowall-small-block">
<?php foreach( $model as $i => $one ): ?>

	<div class='knowall-small-one-block'>
		<?php 
		echo SeoHide::link('/knowall/'.$one->knowall_category->slug . '/'. $one->slug, CHtml::image($one->getThumb(150,106,'crop'),$one->title, array('title'=>$one->title, 'class'=>'')));
		// echo CHtml::image($one->getThumb(150,106,'crop'),$one->title, array('title'=>$one->title, 'class'=>'')); 
		?>
		
		<div class="knowall-link">
			<?php echo CHtml::link($one->title,'/knowall/'.$one->knowall_category->slug . '/'. $one->slug,array('class'=>'')); ?>
		</div>

		<div class="knowall-category-link">
			<?php echo CHtml::link($one->knowall_category->title,'/knowall/'.$one->knowall_category->slug ,array('class'=>'')); ?>
		</div>

	</div>
	<!-- <div class="clear"></div> -->

<?php endforeach; ?>
</div>
<div class="clear"></div>
</div>


