<div class="logo">
	<a href="/">
		<div class="logo-img">
			<img src="/images/strupko.png" alt="">
		</div>
		<div class="logo-title">SHKOLYAR.INFO</div>
		<div class="logo-description">шкільний інформаційний портал</div>
	</a>

	 <!-- <div class="black"></div>
	 <div class="red"></div>
	 <div class="black"></div> -->
</div>

<div class="footer-menu">
	<ul>
		<li><?php  echo CHtml::link('Про нас', array('/about'), array('rel'=>'nofollow')); ?></li>
		<li><?php  echo CHtml::link('Правила', array('/rules'), array('rel'=>'nofollow')); ?></li>
		<li><?php  echo CHtml::link('Правовласникам', array('/rightholder'), array('rel'=>'nofollow')); ?></li>
		<li><?php  echo CHtml::link('Рекламодавцям', array('/advertiser'), array('rel'=>'nofollow')); ?></li>
		<li><?php  echo CHtml::link('Контакти', array('/contacts'), array('rel'=>'nofollow')); ?></li>
		<li><?php  echo CHtml::link('sitemap.xml', array('/sitemap.xml'), array('rel'=>'nofollow', 'target'=>'_blank')); ?></li>

	</ul>
</div>


<div class="scroll_up">
    <div id="toTop"> <span class="blue glyphicon glyphicon-chevron-up"></span> Наверх </div>
</div>

<!-- Small modal -->
<div class="modal fade" id="fb-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
	        <h5 class="modal-title" id="myModalLabel">Жми «Нравится» и получай все необходимое для учебы в Фейсбуке:</h5>
      	</div>
      	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fshkolyar.info.page&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=false&amp;header=true&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
    	<div class="modal-footer">
    		<button type="button" class="btn btn-default" data-dismiss="modal">Мне уже нравится <span>SHKOLYAR.INFO</span></button>
      </div>
    </div>
  </div>
</div>
