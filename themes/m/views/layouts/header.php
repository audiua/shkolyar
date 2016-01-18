<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button tupe="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
				<span class="sr-only">Menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo ($this->action->id != 'index') ? CHtml::link('SHKOLYAR.INFO', '/', array('class'=>'navbar-brand')): '<span class="navbar-brand">SHKOLYAR.INFO</span>' ?>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="responsive-menu">
			<ul class="nav navbar-nav">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ГДЗ<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php foreach( GdzClas::model()->findAll() as $clas ) : ?>
							<li><a href="<?=Yii::app()->baseUrl.'/gdz/'.$clas->clas->slug; ?>"><?= $clas->clas->slug; ?> клас</a></li>
						<?php endforeach; ?>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Підручники<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php foreach( TextbookClas::model()->findAll() as $clas ) : ?>
							<li><a href="<?=Yii::app()->baseUrl.'/textbook/'.$clas->clas->slug; ?>"><?= $clas->clas->slug; ?> клас</a></li>
						<?php endforeach; ?>
					</ul>
				</li>

				<li>
					<a href="/writing">Твори</a>
				</li>

				<li>
					<a href="/library">Художня література</a>
				</li>

				<li>
					<a href="/knowall">Всезнайка</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'sh_m_big_top'))); ?>

<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'tagName'=>'ol',
    'separator'=>' ',
    'homeLink'=>false,
    'inactiveLinkTemplate'=>'<li class="active">{label}</li>',
    'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
    'htmlOptions'=>array ('class'=>'breadcrumb')
));
?>

