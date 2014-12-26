<div class="row content">
	
	<div class="container-fluid full-h">
		
		<div class="app full-h">

			<div class="row no marg-h">

				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 no full-h ">
					<div class="row no full-h">

						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 full-h ">

							<?php $this->widget('ClasNumbWidget'); ?>

						</div>

						<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9 full-h part bg">
							
							<p class="help"><span class="glyphicon glyphicon-arrow-left"></span> Виберіть клас</p>
						</div>

					</div>
				</div> <!-- col-md-2 -->

				<div class="col-xs-4 col-sm-3 col-md-3 col-lg-8 no full-h part big bg">
					<div class="row no full-h">
						<div class="no row full-h">

							<?php echo CHtml::image(Yii::app()->baseUrl . '/images/404.jpeg'  , 'error 404', array('class'=>'img-responsive error-img')); ?>
							<p class="error"><?php echo $error; ?></p>
						</div>
					</div>
				
				</div> <!-- col-md-2 -->

				<div class=" col-sm-2 col-md-2 col-lg-2 no full-h part reklama ">
					<div class="reklame-inner full-h part no bg">
						<a href="http://web-jewel.ru" target="_blank">Заработок в интернете</a>
					</div>
					
				</div> 
				
			</div>
		</div>
	</div>
</div>

