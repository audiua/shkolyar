<div class="sidebar-block">
	<div class="direct">
		<!-- <img src="http://placehold.it/300x600">  -->
		<!-- <img src="/images/banner.png">  -->
		<img class='big_adsance' src="/images/big.jpeg"> 
	</div>
</div>

<?php if( $this->id == 'gdz' || $this->id == 'textbook' ):  ?>
<div class="sidebar-block">
	<div class="menu">
		<h3>Навігація по розділу <?php echo  $this->id; ?></h3>
		<?php $this->widget('BookSidebarMenuWidget'); ?>
	</div>
	<img src="images/b_l.png" alt="">
	<script type="text/javascript">
    <!--//
    var _sape_partner_refid = 'OAccdEnzQq';
    document.write('<script type="text/javascript" src="//cdn-rtb.sape.ru/partner-b/js/seowizard/swf/4_300x250_1.swf.js"></script>');
    //-->
</script>
</div>
<?php endif; ?>
<div class="clear"></div>


<div class="sidebar-block">
<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "300", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 81422422);
</script>
</div>

<div class="sidebar-block">
	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fshkolyar.info.page&amp;width=300&amp;height=200&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:200px;" allowTransparency="true"></iframe>
</div>

<div class="sidebar-block">
	<h3>Популярні за добу</h3>
	<?php $this->widget('RelativeGdzWidget'); ?>

	<!-- <a href="http://TeaserNet.com/?owner_id=183605"><img src="http://teasernet.com/images/tnet/nets/1/200x200-2.gif "></a> -->
</div>
<!-- <div class="sidebar-block">
	<div class="tizer">
		<h3>tizer</h3>
	</div>
</div> -->




