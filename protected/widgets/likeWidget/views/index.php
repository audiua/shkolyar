<div class="like-btn">
	<!-- Put this script tag to the <head> of your page -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

	<script type="text/javascript">
	  VK.init({apiId: 4750024, onlyWidgets: true});
	</script>

	<!-- VK Widget -->
	<!-- <div class="vk-subscribe">
		<div id="vk_subscribe<?=$id?>"></div>
		<script type="text/javascript">
		VK.Widgets.Subscribe("vk_subscribe<?=$id?>", {soft: 1}, -81422422);
		</script>
	</div> -->
	
	<!-- Put this div tag to the place, where the Like block will be -->
	<div class="vk-like">
		<div id="vk_like<?=$id?>"></div>
		<script type="text/javascript">
		VK.Widgets.Like("vk_like<?=$id?>", {type: "button"});
		</script>
	</div>

	<!-- <div class="fb-like">
		<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fshkolyar.info.page&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=1565122747059411" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
	</div> -->



</div>