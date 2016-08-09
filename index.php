<?php defined('_JEXEC') or die;
/*
 * @copyright  Copyright (C) 2015 - 2016 AHC Waasdorp. All rights reserved.
 * @license    GNU/GPL, see LICENSE
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.

 * 24-4-2016 ook begin en eind van navbar naar module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
* 22-5-1016 brandImage toegevoegd
*/
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$sitename = $app->getCfg('sitename');
$templateparams  = $app->getTemplate(true)->params;

 // bw 6-4-2016
 // Get the template
$template = $app->getTemplate(true);
// Echo the ID
$templatestyleid =  $template->id;  
// v 20160121 variabele style niet meer inline, maar via template.min.<styleid>.css
// 3-4-2016 squeezebox verwijderd ten gunste van magnific popup
// Detecting Active Variables
$itemid   = $app->input->getCmd('Itemid', '');
$displaySitename = htmlspecialchars($templateparams->get('displaySitename')); // 1 yes 2 no 


$bg0Image    	= htmlspecialchars($this->params->get('bg0Image'));
if ($bg0Image > ' ' and strtolower(substr ( $bg0Image , 0 , 7 )) == 'images/' ) 
 {$bg0Image = '/' . $bg0Image;}; 
$bg0Width    	= htmlspecialchars($this->params->get('bg0Width'));
$bg0Top      	= htmlspecialchars($this->params->get('bg0Top'));
$bg0Left      	= htmlspecialchars($this->params->get('bg0Left'));
$bg0Color    	= htmlspecialchars($this->params->get('bg0Color'));
$bg0Size    	= htmlspecialchars($this->params->get('bg0Size'));

$bg1Image    	= htmlspecialchars($this->params->get('bg1Image'));
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};$bg1Width    	= htmlspecialchars($this->params->get('bg1Width'));
$bg1Top      	= htmlspecialchars($this->params->get('bg1Top'));
$bg1Left      	= htmlspecialchars($this->params->get('bg1Left'));
$bg1Color    	= htmlspecialchars($this->params->get('bg1Color'));
$bg1Size    	= htmlspecialchars($this->params->get('bg1Size'));

$bg2Image    	= htmlspecialchars($this->params->get('bg2Image'));
if ($bg2Image > ' ' and strtolower(substr ( $bg2Image , 0 , 7 )) == 'images/' ) 
 {$bg2Image = '/' . $bg2Image;}; 
$bg2Width    	= htmlspecialchars($this->params->get('bg2Width'));
$bg2Top      	= htmlspecialchars($this->params->get('bg2Top'));
$bg2Left      	= htmlspecialchars($this->params->get('bg2Left'));
$bg2Color    	= htmlspecialchars($this->params->get('bg2Color'));
$bg2Size    	= htmlspecialchars($this->params->get('bg2Size'));



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#  fb: http://www.facebook.com/2008/fbml" >
<head>
<jdoc:include type="head" />
<?php
echo '<!-- base is ' . $doc->getBase() .' $templatestyleid ='.$templatestyleid .'  -->';


// Add extra metadata
$doc->setMetaData( 'X-UA-Compatible', 'IE=edge', true ); // http-equiv = true 
$doc->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');
// Add Stylesheets
//JHtmlBootstrap::loadCss();
// Load optional rtl Bootstrap css and Bootstrap bugfixes
//JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700');
// bootstrap stylesheets van cdn
$attribs = array('integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous');
$doc->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$attribs = array('integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous');
$doc->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css');
// standaard bootstrap stijle
// (for js $attribs = array('integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous');
// template stijl
$doc->addStyleSheet('templates/' . $this->template . '/css/template.min.' . $templatestyleid . '.css');
$doc->addScriptDeclaration('jQuery(document).ready(function() {
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
<body id="<?php echo ($itemid ? 'itemid-' . $itemid : ''); ?>">
<?php if ($bg0Size == 'html' && $bg0Image > " ") : ?>
<img id="img_bg0Image" src="<?php echo $bg0Image; ?>" alt="Background image" />
<?php endif; ?>
	<!-- Begin Container-->
        <div id="wrapper" class="container">
<!-- begin html content background images -->
<?php if ($bg1Size == 'html' && $bg1Image > " ") : ?>
<img id="img_bg1Image" src="<?php echo $bg1Image; ?>" alt="Background image content" />
<?php endif; ?>
<?php if ($bg2Size == 'html' && $bg2Image > " ") : ?>
<img id="img_bg2Image" src="<?php echo $bg2Image; ?>" alt="Logo image" />
<?php endif; ?>
<div id="wrapper1">
<!-- eindel content background images -->
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
			</div><!--End Row-->
          
          </div><!--End Container Content-->
      <?php if(  $this->countModules('icons'))    : ?>
       <!-- social icons in principe absoluut geplaatst tov container -->
          <div id="icons">
           <jdoc:include type="modules" name="icons" />
		</div>   
      <?php endif; ?>
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
