<?php
/*------------------------------------------------------------------------
# mod_fblikeboxslider - Ultimate Facebook Like Box Slider
# ------------------------------------------------------------------------
# @author - Twitter Slider
# copyright Copyright (C) 2013 FacebookSlider.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://twitterslider.com/
# Technical Support:  Forum - http://twitterslider.com/index.php/forum
-------------------------------------------------------------------------*/
// no direct access

defined( '_JEXEC' ) or die;
$document = & JFactory::getDocument();
$document->addStyleSheet('modules/mod_fblikeboxslider/assets/style.css');
$margintop = $params->get('margintop');
$fbox1_width = trim($params->get( 'fbwidth' )+0);
?>
<div id="facebook_slider">
	<div id="fbox1" style="right: -<?php echo $fbox1_width;?>px; top: <?php echo $margintop;?>px; z-index: 10000;">
		<div id="fobx2" style="text-align: left;width:<?php echo $params->get('fbwidth'); ?>px;height:<?php echo $params->get('fbheight'); ?>px;">
			<a class="open" id="fblink" href="#"></a><img style="top: 0px;left:-44px;" src="modules/mod_fblikeboxslider/assets/fb.png" alt="">
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $params->get('facebook_url'); ?>&amp;locale=en_GB&amp;width=<?php echo trim( $params->get( 'fbwidth' )+3);  ?>&amp;height=<?php echo trim( $params->get( 'fbheight' )+3);  ?>&amp;show_faces=<?php echo trim( $params->get( 'show_faces' ) );?>&amp;colorscheme=<?php echo trim( $params->get( 'color_scheme' ) );?>&amp;show_border=<?php echo trim( $params->get( 'border' ) );?>&amp;header=<?php echo trim( $params->get( 'header' ) );?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo trim( $params->get( 'fbwidth' )+3);  ?>px; height:<?php echo trim( $params->get( 'fbheight' )+3);  ?>px;" allowtransparency="true"></iframe>
		</div>
				

	</div>
			
</div>
<?php
	if (trim( $params->get( 'loadjquery' ) ) == 1){
	$document->addScript("http://code.jquery.com/jquery-latest.min.js");}
?>
	<script type="text/javascript">
		jQuery.noConflict();
		jQuery(function (){
			jQuery(document).ready(function()
				{
					jQuery.noConflict();
					jQuery(function (){
						jQuery("#fbox1").hover(function(){ 
						jQuery('#fbox1').css('z-index',101009);
						jQuery(this).stop(true,false).animate({right:  0}, 500); },
						function(){ 
						jQuery('#fbox1').css('z-index',10000);
						jQuery("#fbox1").stop(true,false).animate({right: -300}, 500); });
						
						});}); });
					</script>