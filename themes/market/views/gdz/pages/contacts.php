<?php if($this->beginCache('contacts', array('duration'=>86400)) ){ ?>
<div class="row content">
	
	<div class="container-fluid full-h">
		
		<div class="app full-h">

			<div class="row no marg-h">

				<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 no full-h ">
					<div class="row no full-h">

						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 full-h ">

							<?php $this->widget('ClasNumbWidget', array('model'=>$this->allClasModel)); ?>

						</div>

						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 full-h part bg">
							
							<p class="help"><span class="glyphicon glyphicon-arrow-left"></span> Виберіть клас</p>
						</div>

					</div>
				</div> <!-- col-md-2 -->

				<div class="col-xs-9 col-sm-8 col-md-8 col-lg-8 no full-h part big bg">
					<div class="row no full-h">

						<div class="no row full-h">
							
							<div class="desc">

								<h1>Контакти</h1>
								  email: support@mygdz.pp.ua
							</div>

							<h3>Популярні збірники гдз: </h3>
							<div class="populate">
								<?php $this->widget('RelativeBooksWidget', array('mode'=>'all')); ?>
							</div>

							<h3>Нові надходження: </h3>
							<div class="populate">
								<?php $this->widget('RelativeBooksWidget', array('mode'=>'all')); ?>
							</div>

						

						</div>
					</div>
				
				</div> <!-- col-md-2 -->

				<div class="hidden-xs col-sm-2 col-md-2 col-lg-2 no full-h part reklama ">
					<div class="reklame-inner full-h part no bg">
						<?php 
							// $this->renderDynamic('widget', 'application.components.widgets.tizerWidget.TizerWidget',
							//         array('params'=>['mode'=>'vertical']), true);
							$this->widget('TizerWidget', array('params'=>array('mode'=>'vertical'))); 
						?>
					</div>
					
				</div> 
				
			</div>
		</div>
	</div>
</div>
<?php 

	$this->endCache(); 
}

?>