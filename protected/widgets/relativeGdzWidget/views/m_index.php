<div class="separator"></div>
<div class="row">

<?php foreach($model as $data) :?>
	<div class="item col-lg-3 col-md-4 col-sm-4 col-xs-12">
		
			<?php echo Chtml::link('ГДЗ '. $data->gdz_clas->clas->slug . ' клас '. $data->gdz_subject->subject->title . ' ' .$data->author, array('/gdz/'.$data->gdz_clas->clas->slug.'/'.$data->gdz_subject->subject->slug.'/'.$data->slug)) ?>
					
	</div>
<?php endforeach; ?>
</div>