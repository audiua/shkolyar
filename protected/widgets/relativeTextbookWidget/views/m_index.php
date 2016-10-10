<div class="separator"></div>
<div class="row">

<?php foreach($model as $data) :?>
	<div class="item col-lg-3 col-md-4 col-sm-4 col-xs-12">
		
			<?php echo Chtml::link('Підручники '. $data->textbook_clas->clas->slug . ' клас '. $data->textbook_subject->name . ' ' .$data->author, array('/gdz/'.$data->textbook_clas->clas->slug.'/'.$data->textbook_subject->slug.'/'.$data->slug)) ?>
					
	</div>
<?php endforeach; ?>
</div>