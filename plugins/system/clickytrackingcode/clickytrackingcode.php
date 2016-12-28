<?php

/**
 * @package		Clicky Tracking Code - Plugin for Joomla!
 * @author		DeConf - http://www.deconf.com
 * @copyright	Copyright (c) 2010 - 2012 DeConf.com
 * @license		GNU/GPL license: http://www.gnu.org/licenses/gpl-2.0.html
 */
 
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );

class plgSystemClickyTrackingCode extends JPlugin {

 function plgSystemClickyTrackingCode(&$subject, $params) { 
	
	parent::__construct($subject, $params); 
    
	$mode = $this->params->def('mode', 1);
	
}

function onAfterRender(){

		$app =& JFactory::getApplication();
		
		$user =& JFactory::getUser();		
		
		if (( $app->isAdmin()) AND ($this->params->get('clicky_backend'))){
			return;
		}
		
		if ((isset($user->groups[8]) || isset($user->groups[7])) AND ($this->params->get('clicky_admin'))){
			return;
		}
		
		$tracking="";
		$custom_tracking="";
		
		$buffer = JResponse::getBody();
		
		if ($user->username){
		
			if (($this->params->get('clicky_usernames')) AND (($this->params->get('clicky_emails')))){
		
			$custom_tracking="<script type=\"text/javascript\">
  var clicky_custom = {};
  clicky_custom.session = {
    username: '".$user->username."',
    email: '".$user->email."'
  };
</script>";

			}
			else if ($this->params->get('clicky_usernames')){
		
			$custom_tracking="<script type=\"text/javascript\">
  var clicky_custom = {};
  clicky_custom.session = {
    username: '".$user->username."'
  };
</script>";
			}
			else if ($this->params->get('clicky_emails')){
			$custom_tracking="<script type=\"text/javascript\">
  var clicky_custom = {};
  clicky_custom.session = {
    email: '".$user->email."'
  };
</script>";
			}
		}	

		if (($this->params->get('clicky_affiliate')) AND !( $app->isAdmin())){	
			
			if ($this->params->get('clicky_affiliate_id'))
				$affiliate_id=$this->params->get('clicky_affiliate_id');
			else
				$affiliate_id="66508224";
			$tracking.="<center><a title=\"Web Analytics\" href=\"http://clicky.com/".$affiliate_id."\"><img alt=\"Web Analytics\" src=\"//static.getclicky.com/media/links/badge.gif\" border=\"0\" /></a></center>";	
		
		}
		
		if ($this->params->get('clicky_id')){
		
			$tracking.="<script type='text/javascript'>
	var clicky_site_ids = clicky_site_ids || [];
	clicky_site_ids.push(".$this->params->get('clicky_id').");
	(function() {
	  var s = document.createElement('script');
	  s.type = 'text/javascript';
	  s.async = true;
	  s.src = '//static.getclicky.com/js';
	  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
	})();
</script>"; 
	}
	
		if ($custom_tracking){
			$buffer = preg_replace ("/<\/body>/", "\n".$custom_tracking."\n</body>", $buffer);
		}	
		
		if ($tracking){
			$buffer = preg_replace ("/<\/body>/", "\n".$tracking."\n</body>", $buffer);
		}
		
		JResponse::setBody($buffer);
	
	return;
 
 }
 
}