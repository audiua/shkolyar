<h1>Карта порталу <span class="shkolyar">shkolyar.info</span></h1>

<div class="clear"></div>


<?php echo CHtml::link('ГДЗ', '/gdz'); ?><br>
<?php 
$criteria = new CDbCriteria;
$criteria->group = 't.clas_id';
$allClas = GdzClas::model()->findAll($criteria);
$time = time();
foreach( $allClas as $clas ):?>
	<?php echo CHtml::link($clas->clas->slug, '/gdz/'.$clas->clas->slug, array('style'=>'margin-left:20px;')); ?><br>

	<?php foreach($clas->gdz_subject as $subject):?>
		<?php echo CHtml::link($subject->subject->title, '/gdz/'.$clas->clas->slug.'/'.$subject->subject->slug, array('style'=>'margin-left:40px;')); ?><br>

		<?php foreach($subject->gdz_book as $book):
			if( strtotime($book->public_time) > $time || ! $book->public ) continue; ?>
			<?php echo CHtml::link($book->author, '/gdz/'.$clas->clas->slug.'/'.$subject->subject->slug . '/'.$book->slug, array('style'=>'margin-left:60px;')); ?><br>
		<?php endforeach;?>

	<?php endforeach;?>


<?php endforeach;?>

<div class="clear"></div>

<?php echo CHtml::link('Підручники', '/textbook'); ?><br>
<?php 
$criteria = new CDbCriteria;
$criteria->group = 't.clas_id';
$allClas = TextbookClas::model()->findAll($criteria);
foreach( $allClas as $clas ):?>
	<?php echo CHtml::link($clas->clas->slug, '/textbook/'.$clas->clas->slug, array('style'=>'margin-left:20px;')); ?><br>

	<?php foreach($clas->textbook_subject as $subject):
		if( $subject->subject->slug == 'math' || $subject->subject->slug == 'algebra' ):?>
		<?php echo CHtml::link($subject->subject->title, '/textbook/'.$clas->clas->slug.'/'.$subject->subject->slug, array('style'=>'margin-left:40px;')); ?><br>

		<?php 
		foreach($subject->textbook_book as $book):
			if( strtotime($book->public_time) > $time || ! $book->public ) continue; ?>
			<?php echo CHtml::link($book->author, '/textbook/'.$clas->clas->slug.'/'.$subject->subject->slug . '/'.$book->slug, array('style'=>'margin-left:60px;')); ?><br>
		<?php endforeach;?>

	<?php endif; endforeach;?>


<?php endforeach;?>

<div class="clear"></div>

<?php echo CHtml::link('Твори', '/writing'); ?><br>
<?php foreach( Clas::model()->findAll() as $clas ):?>
	<?php echo CHtml::link($clas->slug, '/writing/'.$clas->slug, array('style'=>'margin-left:20px;')); ?><br>

	<?php 

	$a=array(3,4);
	$allSubject = Subject::model()->findAllByPk($a);
	foreach($allSubject as $subject):?>
		<?php echo CHtml::link($subject->title, '/writing/'.$clas->slug.'/'.$subject->slug, array('style'=>'margin-left:40px;')); ?><br>

		<?php 
		$criteria = new CdbCriteria;
		$criteria->condition = 't.clas_id='.$clas->id;
		$criteria->addCondition('t.subject_id='.$subject->id);
		$allWriting = Writing::model()->findAll($criteria);
		foreach($allWriting as $writing):
			if( strtotime($writing->public_time) > $time || ! $writing->public ) continue; ?>
			<?php echo CHtml::link($writing->title, '/writing/'.$clas->slug.'/'.$subject->slug . '/'.$writing->slug, array('style'=>'margin-left:60px;')); ?><br>
		<?php endforeach;?>

	<?php endforeach;?>


<?php endforeach;?>

<div class="clear"></div>

<?php echo CHtml::link('Художня література', '/library'); ?><br>
<?php foreach( LibraryAuthor::model()->findAll() as $author ):?>
	<?php echo CHtml::link($author->author, '/library/'.$author->slug, array('style'=>'margin-left:20px;')); ?><br>

	<?php foreach($author->library_book as $book):
		if( strtotime($book->public_time) > $time || ! $book->public ) continue; ?>
		<?php echo CHtml::link($book->title, '/library/'.$author->slug.'/'.$book->slug, array('style'=>'margin-left:40px;')); ?><br>

	<?php endforeach;?>


<?php endforeach;?>

<div class="clear"></div>

<?php echo CHtml::link('Всезнайка', '/knowall'); ?><br>
<?php foreach( KnowallCategory::model()->findAll() as $category ):?>
	<?php echo CHtml::link($category->title, '/knowall/'.$category->slug, array('style'=>'margin-left:20px;')); ?><br>

	<?php foreach($category->knowall as $knowall):
		if( strtotime($knowall->public_time) > $time || ! $knowall->public ) continue; ?>
		<?php echo CHtml::link($knowall->title, '/knowall/'.$category->slug.'/'.$knowall->slug, array('style'=>'margin-left:40px;')); ?><br>

	<?php endforeach;?>


<?php endforeach;?>