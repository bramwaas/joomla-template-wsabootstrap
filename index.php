<?php defined('_JEXEC') or die;
/*
 * @copyright  Copyright (C) 2015 - 2018 AHC Waasdorp. All rights reserved.
 * @license    GNU/GPL, see LICENSE
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 20160121 variabele style niet meer inline, maar via template.min.<styleid>.css
 * 3-4-2016 squeezebox verwijderd ten gunste van magnific popup
 * 24-4-2016 ook begin en eind van navbar naar module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
* 22-5-2016 brandImage toegevoegd
* 28-12-2016 alle achtergrond images in html en met srcset, dus geen uitvraging op Bg.size = 'html' meer,
* wel extra images voor grotere breedte met toevoeging _lg 
* 2-1-2017 breakpoint for sizes srcset
* 7-1-2017 naast -lg nu ook _sm
* 4-2-2017 ook defer bij caption.js
* 27-4-2017 naam CSS variabel
* 22/9/2017 http in https veranderd bij googleapis
* 01/01/2018 6/1 voorbereidingen voor J4 door deleen van cassiopeia te kopieren en misschien aan te passen in die richting.
// $app = JFactory::getApplication();  // using from cassiopeia
// $doc = JFactory::getDocument();   // using J38+ Api
//$doc = Factory::getDocument();
// use Joomla\CMS\Document\Document;  // o.a. metadata stylesheet en script komt kennelijk overeen met $this dus overal $doc vervangen door $this
// addStylesheet and addScript Deprecated  in 4.0 The (url, mime, defer, async) method signature is deprecated, use (url, options, attributes) instead.
10-1-2018
// 24-12-2018 1.4.1 december 2018 leading / deleted in images directory for use in subdomain
25-12-2018 1.4.2 optioneel invoegen twbs js en css
19-1-2019 timestamp als versie voor template.css
20-1-2019 icons verplaatst
25-1-2019 nieuwe versie BS 4
*/

// copied from cassiopeia
use Joomla\CMS\Factory;   // this is the same as use Joomla\CMS\Factory as Factory
//use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;   // voor vertalingen???
// end copied from cassiopeia
/** @var JDocumentHtml $this */

$app  = Factory::getApplication();
$lang = Factory::getLanguage();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu->params->get('pageclass_sfx');

// end copied from cassiopeia

// Get the template, params and id 
$template = $app->getTemplate(true);
$templateparams  = $template->params;
$templatestyleid =  $template->id;  
$displaySitename = htmlspecialchars($templateparams->get('displaySitename')); // 1 yes 2 no 


$bg0Image    	= htmlspecialchars($this->params->get('bg0Image'));
// if ($bg0Image > ' ' and strtolower(substr ( $bg0Image , 0 , 7 )) == 'images/' )  {$bg0Image = '/' . $bg0Image;}; 
$bg0Image_lg    	= htmlspecialchars($this->params->get('bg0Image_lg'));
// if ($bg0Image_lg > ' ' and strtolower(substr ( $bg0Image_lg , 0 , 7 )) == 'images/' ) {$bg0Image_lg = '/' . $bg0Image_lg;};
$bg0Breakpoint_lg 	= htmlspecialchars($this->params->get('bg0Breakpoint_lg'));
$bg0Image_sm    	= htmlspecialchars($this->params->get('bg0Image_sm'));
// if ($bg0Image_sm > ' ' and strtolower(substr ( $bg0Image_sm , 0 , 7 )) == 'images/' )  {$bg0Image_sm = '/' . $bg0Image_sm;};
$bg0Breakpoint_sm 	= htmlspecialchars($this->params->get('bg0Breakpoint_sm'));

$bg0Width    	= htmlspecialchars($this->params->get('bg0Width'));
$bg0Top      	= htmlspecialchars($this->params->get('bg0Top'));
$bg0Left      	= htmlspecialchars($this->params->get('bg0Left'));
$bg0Color    	= htmlspecialchars($this->params->get('bg0Color'));
$bg0ImageW    	= htmlspecialchars($this->params->get('bg0ImageW'));
$bg0ImageH    	= htmlspecialchars($this->params->get('bg0ImageH'));
$bg0Image_lgW  	= htmlspecialchars($this->params->get('bg0Image_lgW'));
$bg0Image_smW  	= htmlspecialchars($this->params->get('bg0Image_smW'));

$bg1Image    	= htmlspecialchars($this->params->get('bg1Image'));
// if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' )  {$bg1Image = '/' . $bg1Image;};
$bg1Image_lg    	= htmlspecialchars($this->params->get('bg1Image_lg'));
// if ($bg1Image_lg > ' ' and strtolower(substr ( $bg1Image_lg , 0 , 7 )) == 'images/' )  {$bg1Image_lg = '/' . $bg1Image_lg;};
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg1Image_sm    	= htmlspecialchars($this->params->get('bg1Image_sm'));
// if ($bg1Image_sm > ' ' and strtolower(substr ( $bg1Image_sm , 0 , 7 )) == 'images/' )  {$bg1Image_sm = '/' . $bg1Image_sm;};
$bg1Breakpoint_sm    	= htmlspecialchars($this->params->get('bg1Breakpoint_sm'));

$bg1Width    	= htmlspecialchars($this->params->get('bg1Width'));
$bg1Top      	= htmlspecialchars($this->params->get('bg1Top'));
$bg1Left      	= htmlspecialchars($this->params->get('bg1Left'));
$bg1Color    	= htmlspecialchars($this->params->get('bg1Color'));
$bg1ImageW    	= htmlspecialchars($this->params->get('bg1ImageW'));
$bg1ImageH    	= htmlspecialchars($this->params->get('bg1ImageH'));
$bg1Image_lgW  	= htmlspecialchars($this->params->get('bg1Image_lgW'));
$bg1Image_smW  	= htmlspecialchars($this->params->get('bg1Image_smW'));

$bg2Image    	= htmlspecialchars($this->params->get('bg2Image'));
// if ($bg2Image > ' ' and strtolower(substr ( $bg2Image , 0 , 7 )) == 'images/' )  {$bg2Image = '/' . $bg2Image;}; 
$bg2Image_lg    	= htmlspecialchars($this->params->get('bg2Image_lg'));
// if ($bg2Image_lg > ' ' and strtolower(substr ( $bg2Image_lg , 0 , 7 )) == 'images/' )  {$bg2Image_lg = '/' . $bg2Image_lg;}; 
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg2Image_sm    	= htmlspecialchars($this->params->get('bg2Image_sm'));
// if ($bg2Image_sm > ' ' and strtolower(substr ( $bg2Image_sm , 0 , 7 )) == 'images/' )  {$bg2Image_sm = '/' . $bg2Image_sm;};
$bg1Breakpoint_sm    	= htmlspecialchars($this->params->get('bg1Breakpoint_sm')); 
 
$bg2Width    	= htmlspecialchars($this->params->get('bg2Width'));
$bg2Top      	= htmlspecialchars($this->params->get('bg2Top'));
$bg2Left      	= htmlspecialchars($this->params->get('bg2Left'));
$bg2Color    	= htmlspecialchars($this->params->get('bg2Color'));
$bg2ImageW    	= htmlspecialchars($this->params->get('bg2ImageW'));
$bg2ImageH    	= htmlspecialchars($this->params->get('bg2ImageH'));
$bg2Image_lgW  	= htmlspecialchars($this->params->get('bg2Image_lgW'));
$bg2Image_smW  	= htmlspecialchars($this->params->get('bg2Image_smW'));

$wsaCssFilename = strtolower(htmlspecialchars($this->params->get('wsaCssFilename')));
if ($wsaCssFilename > " ")
{$path_parts = pathinfo($wsaCssFilename);
if (path_parts['extension'] <> 'css'){$wsaCssFilename = $wsaCssFilename . '.css';};
}
else
{ $wsaCssFilename = 'template.min.' . $templatestyleid . '.css';}

$twbs_version 		= htmlspecialchars($this->params->get('twbs_version', '4'));
$include_twbs_css	= htmlspecialchars($this->params->get('include_twbs_css', '1'));
$include_twbs_js	= htmlspecialchars($this->params->get('include_twbs_js','1'));
$wsaTime            = htmlspecialchars($this->params->get('wsaTime',''));
$wsaTime 			= strtr($wsaTime, array(' '=> 't', ':' => '' ))

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#  fb: http://www.facebook.com/2008/fbml" >
<head>
<jdoc:include type="head" />
<?php
echo '<!-- base is ' . $this->getBase() .' $templatestyleid ='.$templatestyleid .'  -->';


// Add extra metadata
$this->setMetaData( 'X-UA-Compatible', 'IE=edge', true ); // http-equiv = true 
$this->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
// stylesheets
$this->addStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' , array('version'=>'auto'), array('id'=>'googleapis-fonts.css'));
// bootstrap stylesheets van cdn

if ($twbs_version == "3") {
   if ($include_twbs_css == "1") {
	$attribs = array('id'=>'bootstrap.min.css', 'integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous');
	$this->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('version'=>'3.3.7'),  $attribs);
	$attribs = array('id'=>'bootstrap-theme.min.css', 'integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous');
	$this->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' , array('version'=>'3.3.7'), $attribs);
   }
}
else {
	if ($include_twbs_css == "1") {
	$attribs = array('id'=>'bootstrap.min.css', 'integrity' => 'sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS', 'crossorigin' => 'anonymous');
	$this->addStyleSheet('https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', array('version'=>'4.2.1'),  $attribs);

	//$attribs = array('id'=>'bootstrap-theme.min.css', 'integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous');
	//$this->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' , array('version'=>'3.3.7'), $attribs);
	}
}	

// template stijl
$attribs = array('id'=>'template.css');
$this->addStyleSheet('templates/' . $this->template . '/css/' . $wsaCssFilename , array('version'=>$wsaTime), $attribs);

// Add JavaScript 

//HTMLHelper::_('jquery.framework');  // to be sure that jquery is loaded before dependent javascripts
if ($twbs_version == "3") {
    if ($include_twbs_js == "1") {
	$this->addScript('templates/' . $this->template . '/js/jui/bootstrap.min.js', array('version'=>'3.3.7'), 
		array('id'=>'bootstrap.min.js', 'defer'=>'defer'));
    }
}
else {
	if ($include_twbs_js == "1") {
	    $this->addScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', array('version'=>'1.14.6'),
	        array('id'=>'popper.js', 'integrity' => 'sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut',   'crossorigin' => 'anonymous'));
	    $this->addScript('https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', array('version'=>'4.2.1'),
	        array('id'=>'bootstrap.min.js', 'integrity' => 'sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k',   'crossorigin' => 'anonymous'));
    }
	    
}

$this->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js', array('version'=>'1-1-0'), array('id'=>'MagnificPopupV1-1-0.js', 'defer'=>'defer'));
$this->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js', array('version'=>'auto'), array('id'=>'template.js', 'defer'=>'defer'));
$this->addScript($this->baseurl  . '/media/system/js/caption.js' , array('version'=>'auto'), array('id'=>'caption.js', 'defer'=>'defer')); // defer caption.js.  	
	
$this->addScriptDeclaration('jQuery(document).ready(function() {
  jQuery(\'a[rel*="lightbox"], a[data-wsmodal]\').magnificPopup({
type: \'image\'
, closeMarkup : \'<button title="%title%" type="button" class="mfp-close">&nbsp;</button>\'
});})');  
// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6  col-xs-12 col-md-6" ;
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9  col-xs-12 col-md-9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9  col-xs-12 col-md-9";
}
else
{
	$span = "span12  col-xs-12";
}
?>

<!--[if lt IE 9]>
<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
<![endif]-->
<!--[if lte IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_IEold.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 8]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_IE8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 9]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_IE9.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body id="<?php echo ($itemid ? 'itemid-' . $itemid : ''); ?>"
<?php // added from cassiopeia ?>
class="site-grid site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ' ' . $pageclass;
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>"

>
<?php if ($bg0Image > " " )
{ echo "\n" . '<img id="img_bg0Image" src="' . $bg0Image . '" alt="Background image"';
	if ($bg0ImageW > 0 ) {echo "\n\t" . 'width="' . $bg0ImageW .'"';}
	if ($bg0ImageH > 0 ) {echo "\n\t" . 'height="' . $bg0ImageH . '"';}
	if ($bg0ImageW > 0  && (($bg0Image_lg > " " && $bg0Image_lgW > 0) || ($bg0Image_sm > " " && $bg0Image_smW > 0))  )
	{echo "\n\t" . 'srcset="' . $bg0Image . ' ' . $bg0ImageW .'w'   ;
	if ($bg0Image_lgW > 0) {echo ','. $bg0Image_lg .' ' . $bg0Image_lgW . 'w' ; }
	if ($bg0Image_smW > 0) {echo ','. $bg0Image_sm .' ' . $bg0Image_smW . 'w' ; }
	echo '"';
	if ($bg0Breakpoint_lg > 0 || $bg0Breakpoint_sm > 0)
		{echo "\n\t" . 'sizes="';
		if ($bg0Breakpoint_sm > 0 ) {echo '(max-width: ' . $bg0Breakpoint_sm .'px) '.$bg0Image_smW .'px,'; }
		if ($bg0Breakpoint_lg > 0 ) {echo '(min-width: ' . $bg0Breakpoint_lg .'px) '.$bg0Image_lgW .'px,'; }
		echo $bg0ImageW .'px"'; 
		}
	} 
 echo  ' />' . "\n";
}?>
<!-- Begin Container-->
	<div id="wrapper" class="container">
<?php if ($bg1Image > " " )
{ echo "\n" . '<img id="img_bg1Image" src="' . $bg1Image . '" alt="Background image content"';
	if ($bg1ImageW > 0 ) {echo "\n\t" . 'width="' . $bg1ImageW .'"';}
	if ($bg1ImageH > 0 ) {echo "\n\t" . 'height="' . $bg1ImageH . '"';}
	if ($bg1ImageW > 0  && (($bg1Image_lg > " " && $bg1Image_lgW > 0) || ($bg1Image_sm > " " && $bg1Image_smW > 0))  )
	{echo "\n\t" . 'srcset="' . $bg1Image . ' ' . $bg1ImageW .'w'   ;
	if ($bg1Image_lgW > 0) {echo ','. $bg1Image_lg .' ' . $bg1Image_lgW . 'w' ; }
	if ($bg1Image_smW > 0) {echo ','. $bg1Image_sm .' ' . $bg1Image_smW . 'w' ; }
	echo '"';
	if ($bg1Breakpoint_lg > 0 || $bg1Breakpoint_sm > 0)
		{echo "\n\t" . 'sizes="';
		if ($bg1Breakpoint_sm > 0 ) {echo '(max-width: ' . $bg1Breakpoint_sm .'px) '.$bg1Image_smW .'px,'; }
		if ($bg1Breakpoint_lg > 0 ) {echo '(min-width: ' . $bg1Breakpoint_lg .'px) '.$bg1Image_lgW .'px,'; }
		echo $bg1ImageW .'px"'; 
		}
	} 
 echo  ' />' . "\n";
}?>
<?php if ($bg2Image > " " )
{ echo "\n" . '<img id="img_bg2Image" src="' . $bg2Image . '" alt="Logo image"';
	if ($bg2ImageW > 0 ) {echo "\n\t" . 'width="' . $bg2ImageW .'"';}
	if ($bg2ImageH > 0 ) {echo "\n\t" . 'height="' . $bg2ImageH . '"';}
	if ($bg2ImageW > 0  && (($bg2Image_lg > " " && $bg2Image_lgW > 0) || ($bg2Image_sm > " " && $bg2Image_smW > 0))  )
	{echo "\n\t" . 'srcset="' . $bg2Image . ' ' . $bg2ImageW .'w'   ;
	if ($bg2Image_lgW > 0) {echo ','. $bg2Image_lg .' ' . $bg2Image_lgW . 'w' ; }
	if ($bg2Image_smW > 0) {echo ','. $bg2Image_sm .' ' . $bg2Image_smW . 'w' ; }
	echo '"';
	if ($bg2Breakpoint_lg > 0 || $bg2Breakpoint_sm > 0)
		{echo "\n\t" . 'sizes="';
		if ($bg2Breakpoint_sm > 0 ) {echo '(max-width: ' . $bg2Breakpoint_sm .'px) '.$bg2Image_smW .'px,'; }
		if ($bg2Breakpoint_lg > 0 ) {echo '(min-width: ' . $bg2Breakpoint_lg .'px) '.$bg2Image_lgW .'px,'; }
		echo $bg2ImageW .'px"'; 
		}
	} 
 echo  ' />' . "\n";
}?>
<div id="wrapper1">
		<!-- Begin Header-->
		<div class="header">
			<div class="header-inner">
				<?php if ($this->countModules('position-0')): ?>
				<div class="pos0">
					<jdoc:include type="modules" name="position-0" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos0-->
				<?php endif; ?>
				<?php if(  $this->countModules('headerleft'))    : ?>
				<div id="headerleft">
					<div class="inner">
						<jdoc:include type="modules" name="headerleft"  />
					<div class="clearfix"></div>
					</div>
				</div><!--einde headerleft-->  
  				<?php endif; ?>
				<?php if ($this->countModules('position-4')): ?>
				<div class="pos4">
					<jdoc:include type="modules" name="position-4" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos4-->
				<?php endif; ?>
				<?php if ($this->countModules('position-5')): ?>
				<div class="pos5 bigimage">
					<jdoc:include type="modules" name="position-5" style="none" />
					<div class="clearfix"></div>
				</div><!--End Bigimage-->
				<?php endif; ?>
				<?php if ($this->countModules('position-6')): ?>
				<div class="pos6">
					<jdoc:include type="modules" name="position-6" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos6-->
				<?php endif; ?>
				<div class="clearfix"></div>
			</div><!--End Header-Inner-->
		</div><!--End Header-->
		<!-- Begin Container content-->
		<div class="container-content">
		    	<?php if ($this->countModules('position-1')): ?>
	            	    <jdoc:include type="modules" name="position-1" style="none" />
		    	<?php endif; ?>
			<div class="row">
				<?php if ($this->countModules('position-8')): ?>
				<div id="sidebarleft" class="pos8 span3  col-xs-12 col-md-3">
					<jdoc:include type="modules" name="position-8" style="well" /><!--End Position-8-->
				</div><!--End Sidebar Left-->
				<?php endif; ?>
				<div id="content" class="<?php echo $span;?>">
					<?php if ($this->countModules('position-2')): ?>
					<div class="pos2">
						<jdoc:include type="modules" name="position-2" style="none" />
						<div class="clearfix"></div>
					</div><!--End Pos2-->
					<?php endif; ?>
					<?php if ($this->countModules('position-3')): ?>
					<div class="pos3">
						<jdoc:include type="modules" name="position-3" style="none" />
						<div class="clearfix"></div>
					</div><!--End Pos3-->
					<?php endif; ?>
					<jdoc:include type="message" />
					<jdoc:include type="component" />
				</div><!--Content -->
				<?php if ($this->countModules('position-7')) : ?>
				<div id="sidebarright" class="pos7 span3  col-xs-12 col-md-3">
					<jdoc:include type="modules" name="position-7" style="well" /><!--End Position-7-->
				</div><!--End Sidebar Right-->
				<?php endif; ?>
 				<?php if(  $this->countModules('icons'))    : ?>
				<div id="icons">
					<jdoc:include type="modules" name="icons" />
				</div>   
				<?php endif; ?>
			</div><!--End Row-->
         
          </div><!--End Container Content-->
	<!-- Begin Footer -->
	<div class="footer">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right"><a href="#" id="back-top">&uarr; Top</a></p>
			<p>&copy; <?php echo $sitename; ?> <?php echo date('Y');?></p>
	</div>
    <!--End Footer-->
	</div> <!-- end wrapper1 -->
	</div><!--End Container-->
	<?php if ($this->countModules('messageIE')): ?>
	<!--[if lte IE 7]>
	<div class="message-ie"><jdoc:include type="modules" name="messageIE" style="none" /></div>
	<![endif]-->
	<?php endif; ?>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
