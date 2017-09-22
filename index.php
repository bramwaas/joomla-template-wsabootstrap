<?php defined('_JEXEC') or die;
/*
 * @copyright  Copyright (C) 2015 - 2017 AHC Waasdorp. All rights reserved.
 * @license    GNU/GPL, see LICENSE
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.

 * 24-4-2016 ook begin en eind van navbar naar module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
* 22-5-2016 brandImage toegevoegd
* 28-12-2016 alle achtergrond images in html en met srcset, dus geen uitvraging op Bg.size = 'html' meer,
* wel extra images voor grotere breedte met toevoeging _lg 
* 2-1-2017 breakpoint for sizes srcset
* 7-1-2017 naast -lg nu ook _sm
* 4-2-2017 ook defer bij caption.js
* 27-4-2017 naam CSS variabel
* 22/9/2017 http in https veranderd bij googleapis
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
$bg0Image_lg    	= htmlspecialchars($this->params->get('bg0Image_lg'));
if ($bg0Image_lg > ' ' and strtolower(substr ( $bg0Image_lg , 0 , 7 )) == 'images/' )
 {$bg0Image_lg = '/' . $bg0Image_lg;};
$bg0Breakpoint_lg 	= htmlspecialchars($this->params->get('bg0Breakpoint_lg'));
$bg0Image_sm    	= htmlspecialchars($this->params->get('bg0Image_sm'));
if ($bg0Image_sm > ' ' and strtolower(substr ( $bg0Image_sm , 0 , 7 )) == 'images/' )
 {$bg0Image_sm = '/' . $bg0Image_sm;};
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
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};
$bg1Image_lg    	= htmlspecialchars($this->params->get('bg1Image_lg'));
if ($bg1Image_lg > ' ' and strtolower(substr ( $bg1Image_lg , 0 , 7 )) == 'images/' ) 
 {$bg1Image_lg = '/' . $bg1Image_lg;};
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg1Image_sm    	= htmlspecialchars($this->params->get('bg1Image_sm'));
if ($bg1Image_sm > ' ' and strtolower(substr ( $bg1Image_sm , 0 , 7 )) == 'images/' )
 {$bg1Image_sm = '/' . $bg1Image_sm;};
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
if ($bg2Image > ' ' and strtolower(substr ( $bg2Image , 0 , 7 )) == 'images/' ) 
 {$bg2Image = '/' . $bg2Image;}; 
$bg2Image_lg    	= htmlspecialchars($this->params->get('bg2Image_lg'));
if ($bg2Image_lg > ' ' and strtolower(substr ( $bg2Image_lg , 0 , 7 )) == 'images/' ) 
 {$bg2Image_lg = '/' . $bg2Image_lg;}; 
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg2Image_sm    	= htmlspecialchars($this->params->get('bg2Image_sm'));
if ($bg2Image_sm > ' ' and strtolower(substr ( $bg2Image_sm , 0 , 7 )) == 'images/' )
 {$bg2Image_sm = '/' . $bg2Image_sm;};
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
// Add Stylesheets
$doc->addStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700');
// bootstrap stylesheets van cdn
$attribs = array('integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous');
$doc->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', 'text/css', null,  $attribs);
$attribs = array('integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous');
$doc->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' , 'text/css', null, $attribs);
// template stijl
$doc->addStyleSheet('templates/' . $this->template . '/css/' . $wsaCssFilename);

// Add JavaScript 
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js', 'text/javascript', true, false);
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js', 'text/javascript', true, false);
$doc->addScript($this->baseurl  . '/media/system/js/caption.js' , 'text/javascript', true, false); // defer caption.js.  	
	
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
