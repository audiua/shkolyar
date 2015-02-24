<div class="last-knowall">
<?php $first = array_shift($model); ?>
<div class="knowall-large-block">
	<?php echo CHtml::image($first->getThumb(350,280,'crop'),$first->title, array('title'=>$first->title, 'class'=>'')); ?>
	<div class="knowall-link">
		<?php echo CHtml::link($first->title,'/writing/'.$first->clas->slug . '/'.$first->subject->slug .'/'. $first->slug,array('class'=>'')); ?>
	</div>

	<div class="knowall-category-link">
			<?php echo CHtml::link($first->clas->slug .' клас', '/writing/'.$first->clas->slug,array('class'=>''));
			echo '<span>, </span>'.  CHtml::link(Helper::getShort($first->subject->title), '/writing/'.$first->clas->slug . '/'.$first->subject->slug ,array('class'=>''));  ?>
	</div>
</div>

<div class="knowall-small-block">
<?php foreach( $model as $i => $one ): ?>

	<div class='knowall-small-one-block'>
		<?php echo CHtml::image($one->getThumb(150,106,'crop'),$one->title, array('title'=>$one->title, 'class'=>'')); ?>
		
		<div class="knowall-link">
			<?php echo CHtml::link($one->title,'/writing/'.$one->clas->slug . '/'.$one->subject->slug .'/'. $one->slug ,array('class'=>'')); ?>
		</div>

		<div class="knowall-category-link">
			<?php echo CHtml::link($one->clas->slug, '/writing/'.$one->clas->slug,array('class'=>''));
			echo '<span>, </span>'.  CHtml::link(Helper::getShort($one->subject->title), '/writing/'.$one->clas->slug . '/'.$one->subject->slug ,array('class'=>''));  ?>
		</div>

	</div>
	<!-- <div class="clear"></div> -->

<?php endforeach; ?>
</div>
<div class="clear"></div>
</div>
