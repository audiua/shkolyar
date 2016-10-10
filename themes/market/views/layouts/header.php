<div class="logo">
	<?php echo SeoHide::link('/', '<div class="logo-img">
      <img src="/images/strupko.png" alt="">
    </div>
    <div class="logo-title">SHKOLYAR.INFO</div>
    <div class="logo-description">шкільний інформаційний портал</div>'); ?>

	<div class="black"></div>
	<div class="red"></div>
	<div class="black"></div>
</div>

<div class="header-menu">
	<ul>
		<li class="<?php echo Yii::app()->controller->getId() == 'gdz' ? 'active' : '' ; ?> gdz" >
			<?= SeoHide::link("/gdz", 'ГДЗ'); ?>
			<div class="gdz-table">
				<table>
					<thead>
						<tr>
							<th data-vertical="0"></th>
							<th class="clas-5" data-vertical="1"><?= SeoHide::link("/gdz/5", '5 <br><span>клас</span>', array('class'=>'clas-5')); ?></th>
							<th class="clas-5" data-vertical="2"><?= SeoHide::link("/gdz/6", '6 <br><span>клас</span>', array('class'=>'clas-6')); ?></th>
							<th class="clas-5" data-vertical="3"><?= SeoHide::link("/gdz/7", '7 <br><span>клас</span>', array('class'=>'clas-7')); ?></th>
							<th class="clas-5" data-vertical="4"><?= SeoHide::link("/gdz/8", '8 <br><span>клас</span>', array('class'=>'clas-8')); ?></th>
							<th class="clas-5" data-vertical="5"><?= SeoHide::link("/gdz/9", '9 <br><span>клас</span>', array('class'=>'clas-9')); ?></th>
							<th class="clas-5" data-vertical="6"><?= SeoHide::link("/gdz/10", '10 <br><span>клас</span>', array('class'=>'clas-10')); ?></th>
							<th class="clas-5" data-vertical="7"><?= SeoHide::link("/gdz/11", '11 <br><span>клас</span>', array('class'=>'clas-11')); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<!-- <td data-vertical="0"><a href="/gdz/math">математика</a></td> -->
							<td data-vertical="0"><span>математика</span></td>
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/math", '<span aria-hidden="true" class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/math", '<span aria-hidden="true" class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<!-- <td data-vertical="1"><a href="/gdz/5/math"><span aria-hidden="true" class="green glyphicon glyphicon-ok small clas-5"></span></a></td> -->
							<!-- <td data-vertical="2"><a href="/gdz/6/math"><span aria-hidden="true" class="green glyphicon glyphicon-ok small clas-6"></span></a></td> -->
							<td data-vertical="3"></td>
							<td data-vertical="4"></td>
							<td data-vertical="5"></td>
							<td data-vertical="6"></td>
							<td data-vertical="7"></td>
						</tr>

						<tr>
							<!-- <td data-vertical="0"><a href="/gdz/lang-ua">українська мова</a></td> -->
							<td data-vertical="0"><span>українська мова</span></td>
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/gdz/8/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/gdz/11/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
							
						</tr>

						<tr>
							<td data-vertical="0"><span>англійська мова</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/lang-en">англійська мова</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/lang-en", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<!-- <td data-vertical="1"><a href="/gdz/5/lang-en"><span class="green glyphicon glyphicon-ok small clas-5"></span></a></td> -->
							<td data-vertical="2"><!-- <a href="/gdz/6/lang-en"><span class="green glyphicon glyphicon-ok small clas-6"></span></a> --></td>
							<td data-vertical="3"><!-- <a href="/gdz/7/lang-en"><span class="green glyphicon glyphicon-ok small clas-7"></span></a> --></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/lang-en"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/lang-en"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/lang-en"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/lang-en"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>російська мова</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/lang-ru">російська мова</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/gdz/8/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/lang-ru", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/lang-ua"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>
						
						<tr>
							<td data-vertical="0"><span>українська література</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/lit-ua">українська література</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/lit-ua"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/lit-ua"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/lit-ua"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/lit-ua"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
							
						</tr>
						
						<tr>
							<td data-vertical="0"><span>світова література</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/lit-w">світова література</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/lit-w", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><!-- <a href="/gdz/6/lit-ua"><span class="green glyphicon glyphicon-ok small clas-6"></span></a> --></td>
							<td data-vertical="3"><!-- <a href="/gdz/7/lit-ua"><span class="green glyphicon glyphicon-ok small clas-7"></span></a> --></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/lit-ua"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/lit-ua"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/lit-ua"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/lit-ua"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
							
						</tr>
						
						<tr>
							<td data-vertical="0"><span>фізика</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/fizika">фізика</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/fizika", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/fizika"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/fizika", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/fizika", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/fizika"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>алгебра</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/algebra">алгебра</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/algebra", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/gdz/8/algebra", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/algebra", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/algebra", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/gdz/11/algebra", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>геометрія</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/geom">геометрія</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/geom", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/geom"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/geom", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/geom", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/gdz/11/geom", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>хімія</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/him">хімія</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/him"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/him", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/him", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/him"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>біологія</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/bio">біологія</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/bio", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/bio"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/bio", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/gdz/10/bio", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/bio"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>географія</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/geogr">географія</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/geogr", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/geogr", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
					
							<td data-vertical="4"><!-- <a href="/gdz/8/geogr"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/geogr", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/geogr"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/geogr"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>інформатика</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/info">інформатика</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/info", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><!-- <a href="/gdz/6/info"><span class="green glyphicon glyphicon-ok small clas-6"></span></a> --></td>
							<td data-vertical="3"><!-- <a href="/gdz/7/info"><span class="green glyphicon glyphicon-ok small clas-7"></span></a> --></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/info"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/info", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/info"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/info"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>основи здоров`я</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/health">основи здоров'я</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/health", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/health", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/health", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/health"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><?= SeoHide::link("/gdz/9/health", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/health"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/health"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>етика</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/etika">етика</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/etika", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz//etika", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><!-- <a href="/gdz/7/etika"><span class="green glyphicon glyphicon-ok small clas-7"></span></a> --></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/etika"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/etika"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/etika"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/etika"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>природознавство</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/nature">природознавство</a></td> -->
							<td data-vertical="1"><?= SeoHide::link("/gdz/5/nature", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/gdz/6/nature", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><!-- <a href="/gdz/7/nature"><span class="green glyphicon glyphicon-ok small clas-7"></span></a> --></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/nature"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/nature"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/nature"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/nature"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>історія України</span></td>
							<!-- <td data-vertical="0"><a href="/gdz/history-ua">історія України</a></td> -->
							<td data-vertical="1"></td>
							<td data-vertical="2"><!-- <a href="/gdz/6/history-ua"><span class="green glyphicon glyphicon-ok small clas-6"></span></a> --></td>
							<td data-vertical="3"><?= SeoHide::link("/gdz/7/history-ua", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><!-- <a href="/gdz/8/history-ua"><span class="green glyphicon glyphicon-ok small clas-8"></span></a> --></td>
							<td data-vertical="5"><!-- <a href="/gdz/9/history-ua"><span class="green glyphicon glyphicon-ok small clas-9"></span></a> --></td>
							<td data-vertical="6"><!-- <a href="/gdz/10/history-ua"><span class="green glyphicon glyphicon-ok small clas-10"></span></a> --></td>
							<td data-vertical="7"><!-- <a href="/gdz/11/history-ua"><span class="green glyphicon glyphicon-ok small clas-11"></span></a> --></td>
						</tr>

					</tbody>
				</table>


			</div>
		</li>

		<li  class="<?php  echo Yii::app()->controller->getId() == 'textbook' ? 'active' : '' ; ?> textbook" >
			<?= SeoHide::link("/textbook", 'Підручники'); ?>
			<div class="textbook-table">
				<table>
					<thead>
						<tr>
							<th data-vertical="0"></th>
							<th class="clas-5" data-vertical="1"><?= SeoHide::link("/textbook/5-clas", '5 <br><span>клас</span>', array('class'=>'clas-5')); ?></th>
							<th class="clas-6" data-vertical="2"><?= SeoHide::link("/textbook/6-clas", '6 <br><span>клас</span>', array('class'=>'clas-6')); ?></th>
							<th class="clas-7" data-vertical="3"><?= SeoHide::link("/textbook/7-clas", '7 <br><span>клас</span>', array('class'=>'clas-7')); ?></th>
							<th class="clas-8" data-vertical="4"><?= SeoHide::link("/textbook/8-clas", '8 <br><span>клас</span>', array('class'=>'clas-8')); ?></th>
							<th class="clas-9" data-vertical="5"><?= SeoHide::link("/textbook/9-clas", '9 <br><span>клас</span>', array('class'=>'clas-9')); ?></th>
							<th class="clas-10" data-vertical="6"><?= SeoHide::link("/textbook/10-clas", '10 <br><span>клас</span>', array('class'=>'clas-10')); ?></th>
							<th class="clas-11" data-vertical="7"><?= SeoHide::link("/textbook/11-clas", '11 <br><span>клас</span>', array('class'=>'clas-11')); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-vertical="0"><span>математика</span></td>
							<td data-vertical="1"><?= SeoHide::link("/textbook/5-clas/matematyka", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/textbook/6-clas/matematyka", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"></td>
							<td data-vertical="4"></td>
							<td data-vertical="5"></td>
							<td data-vertical="6"></td>
							<td data-vertical="7"></td>
						</tr>

						<tr>
							<td data-vertical="0"><span>українська мова</span></td>
							<td data-vertical="1"><a href="/textbook/5-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-5"></span></a></td>
							<td data-vertical="2"><a href="/textbook/6-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-6"></span></a></td>
							<td data-vertical="3"><a href="/textbook/7-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/ukrajinska-mova"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
				
						<tr>
							<td data-vertical="0"><span>українська література</span></td>
							<td data-vertical="1"><a href="/textbook/5-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-5"></span></a></td>
							<td data-vertical="2"><a href="/textbook/6-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-6"></span></a></td>
							<td data-vertical="3"><a href="/textbook/7-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/ukrajinska-literatura"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
							
						</tr>
						
						<tr>
							<td data-vertical="0"><span>російська мова</span></td>
							<td data-vertical="1"><a href="/textbook/5-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-5"></span></a></td>
							<td data-vertical="2"><a href="/textbook/6-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-6"></span></a></td>
							<td data-vertical="3"><a href="/textbook/7-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/rosiyska-mova"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
						
						<tr>
							<td data-vertical="0"><span>зарубіжна література</span></td>
							<td data-vertical="1"><a href="/textbook/5-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-5"></span></a></td>
							<td data-vertical="2"><a href="/textbook/6-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-6"></span></a></td>
							<td data-vertical="3"><a href="/textbook/7-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/zarubizhna-literatura"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
							
						</tr>
						
						<tr>
							<td data-vertical="0"><span>фізика</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><a href="/textbook/7-clas/fizyka"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/fizyka"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/fizyka"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/fizyka"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/10-clas/fizyka"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>алгебра</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><?= SeoHide::link("/textbook/7-clas/algebra", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/textbook/8-clas/algebra", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/textbook/9-clas/algebra", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/textbook/10-clas/algebra", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/textbook/11-clas/algebra", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>геометрія</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><a href="/textbook/7-clas/geometriya"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/geometriya"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/geometriya"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/geometriya"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/geometriya"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>хімія</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"></td>
							<td data-vertical="4"><a href="/textbook/8-clas/khimiya"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/khimiya"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/khimiya"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/khimiya"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>біологія</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"></td>
							<td data-vertical="3"><a href="/textbook/7-clas/biologiya"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/biologiya"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/biologiya"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/biologiya"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/biologiya"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>
						<tr>
							<td data-vertical="0"><span>географія</span></td>
							<td data-vertical="1"></td>
							<td data-vertical="2"><a href="/textbook/6-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-6"></span></a></td>
							<td data-vertical="3"><a href="/textbook/7-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-7"></span></a></td>
							<td data-vertical="4"><a href="/textbook/8-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-8"></span></a></td>
							<td data-vertical="5"><a href="/textbook/9-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-9"></span></a></td>
							<td data-vertical="6"><a href="/textbook/10-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-10"></span></a></td>
							<td data-vertical="7"><a href="/textbook/11-clas/geografiya"><span class="green glyphicon glyphicon-ok small clas-11"></span></a></td>
						</tr>

					</tbody>
				</table>

			</div>
		</li>

		<li  class="<?php  echo Yii::app()->controller->getId() == 'writing' ? 'active' : '' ; ?> writing" >
			<?= SeoHide::link("/writing", 'Твори'); ?>
			<div class="writing-table">
				<table>
					<thead>
						<tr>
							<th data-vertical="0"></th>
							<th class="clas-5" data-vertical="1"><?= SeoHide::link("/writing/5", '5 <br><span>клас</span>', array('class'=>'clas-5')); ?></th>
							<th class="clas-6" data-vertical="2"><?= SeoHide::link("/writing/6", '6 <br><span>клас</span>', array('class'=>'clas-6')); ?></th>
							<th class="clas-7" data-vertical="3"><?= SeoHide::link("/writing/7", '7 <br><span>клас</span>', array('class'=>'clas-7')); ?></th>
							<th class="clas-8" data-vertical="4"><?= SeoHide::link("/writing/8", '8 <br><span>клас</span>', array('class'=>'clas-8')); ?></th>
							<th class="clas-9" data-vertical="5"><?= SeoHide::link("/writing/9", '9 <br><span>клас</span>', array('class'=>'clas-9')); ?></th>
							<th class="clas-10" data-vertical="6"><?= SeoHide::link("/writing/10", '10 <br><span>клас</span>', array('class'=>'clas-10')); ?></th>
							<th class="clas-11" data-vertical="7"><?= SeoHide::link("/writing/11", '11 <br><span>клас</span>', array('class'=>'clas-11')); ?></th>
						</tr>
					</thead>
					<tbody>
					
						<tr>
							<td data-vertical="0"><span>українська мова</span></td>
							<td data-vertical="1"><?= SeoHide::link("/writing/5/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/writing/6/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/writing/7/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/writing/8/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/writing/9/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/writing/10/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/writing/11/lang-ua", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
						</tr>
				
						<tr>
							<td data-vertical="0"><span>українська література</span></td>
							<td data-vertical="1"><?= SeoHide::link("/writing/5/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-5"></span>'); ?></td>
							<td data-vertical="2"><?= SeoHide::link("/writing/6/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-6"></span>'); ?></td>
							<td data-vertical="3"><?= SeoHide::link("/writing/7/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-7"></span>'); ?></td>
							<td data-vertical="4"><?= SeoHide::link("/writing/8/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-8"></span>'); ?></td>
							<td data-vertical="5"><?= SeoHide::link("/writing/9/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-9"></span>'); ?></td>
							<td data-vertical="6"><?= SeoHide::link("/writing/10/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-10"></span>'); ?></td>
							<td data-vertical="7"><?= SeoHide::link("/writing/11/lit-ua", '<span class="green glyphicon glyphicon-ok small clas-11"></span>'); ?></td>
						</tr>
						
					</tbody>
				</table>

			</div>
		</li>

		<li class="<?php  echo Yii::app()->controller->getId() == 'library' ? 'active' : '' ; ?> library"  ><?= SeoHide::link("/library", 'Художня література'); ?>
			<div class="library-block">

				<div role="tabpanel">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#lit-ua" aria-controls="lit-ua" role="tab" data-toggle="tab">Українська література</a></li>
				    <li role="presentation"><a href="#lit-w" aria-controls="lit-w" role="tab" data-toggle="tab">Зарубіжна література</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="lit-ua">
			    		<ul>
			    			<?php foreach( LibraryAuthor::model()->findAll() as $author ): ?>
			    			<li> <?= SeoHide::link("/library/".$author->slug, $author->author, array('class'=>'library-subcategory'));?></li>
			    		<?php endforeach; ?>
			    		</ul>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="lit-w">
						<ul>
						</ul>
			            
				    </div>

				  </div>

				</div>

			</div>

		</li>

		<li class="<?php echo Yii::app()->controller->getId() == 'knowall' ? 'active' : '' ; ?> knowall"  ><?= SeoHide::link("/knowall", 'Всезнайка'); ?>
			<div class="knowall-block">
				<ul>
					<li><?= SeoHide::link("/knowall/nature", 'Природа', array('class'=>'knowall-subcategory')); ?></li>
					<li><?= SeoHide::link("/knowall/planeta", 'Планета', array('class'=>'knowall-subcategory')); ?></li>
					<!-- <li><a class="knowall-subcategory" href="/knowall/money">Заробіток</a></li>
					<li><a class="knowall-subcategory" href="/knowall/men">Людина</a></li> -->
				</ul>
			</div>

		</li>
		

	</ul>
</div>


<!-- <div class="search"> -->
	<form action="/site/search" class="search">

		
		<script>
		  (function() {
		    var cx = '006022602701960109764:drx4nhjaekq';
		    var gcse = document.createElement('script');
		    gcse.type = 'text/javascript';
		    gcse.async = true;
		    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
		        '//www.google.com/cse/cse.js?cx=' + cx;
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(gcse, s);
		  })();
		</script>
		<gcse:searchbox-only></gcse:searchbox-only>
		
		<!-- <div class="show-filters"><span class="blue glyphicon glyphicon-chevron-left"></span></div> -->
		<!-- <input type="text" name="c" value="" class="search-clas" placeholder="Клас" >
		<input type="text" name="s" value="" class="search-subject" placeholder="Предмет" > -->
		<!-- <input type="text" name="a" value="" class="search-text" placeholder="Текст пошуку" > -->
		
		<!-- <button class="search-btn">Пошук</button> -->

	</form>
<!-- </div> -->

