<?php defined('_JEXEC') or die;
/*
 * @copyright  Copyright (C) 2015 - 2022 AHC Waasdorp. All rights reserved.
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
 7-2-2019 1.4.4 en minder achtergondafbeeldingen
 11-2-2019 icons weer naar onder menu
 17-2-2019 nieuwe versie bs4 (4.3.1)
 27-2-2019 enkele sidebar span4 ipv 3
 3-3-2019 door classes aangeven welke modules actief zijn in header-inner en content
 24-8-2021 updated parts copied from cassiopeia.
 23-10-2021 reviewed en overgenomen aanpassingen tbv J4  van wsa_onepage template.
 27-12-2021 check Joomla-version ge 4 to use compatible classes like WebAsset
     Joomla ge 4  stylesheets and javascript via webassets
     Joomla 3 addStylesheet, addScript 
 28-12-2021 default BS5 style and javascript in joomla.asset.json and overrides in code for lower BS versions and styleid specific template style
     and removed conditional inclusion BS stylesheet an javascript       
 */
// copied from cassiopeia
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Version;

/** @var Joomla\CMS\Document\HtmlDocument $this */
$joomlaverge4 = (new Version)->isCompatible('4.0.0');
$app  = Factory::getApplication();
$lang = Factory::getLanguage();
if ($joomlaverge4) {$wa  = $this->getWebAssetManager();}

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = (isset($menu)) ? $menu->getParams()->get('pageclass_sfx'): '';

// end copied from cassiopeia

// Get the template, params and id
$template = $app->getTemplate(true);
$templateparams  = $template->params;
$templatestyleid =  $template->id;

$bg0Color    	= htmlspecialchars($this->params->get('bg0Color'));

$bg1Image    	= htmlspecialchars($this->params->get('bg1Image'));
$bg1Image_lg    	= htmlspecialchars($this->params->get('bg1Image_lg'));
$bg1Breakpoint_lg    	= htmlspecialchars($this->params->get('bg1Breakpoint_lg'));
$bg1Image_sm    	= htmlspecialchars($this->params->get('bg1Image_sm'));
$bg1Breakpoint_sm    	= htmlspecialchars($this->params->get('bg1Breakpoint_sm'));

$bg1Color    	= htmlspecialchars($this->params->get('bg1Color'));
$bg1ImageW    	= htmlspecialchars($this->params->get('bg1ImageW'));
$bg1ImageH    	= htmlspecialchars($this->params->get('bg1ImageH'));
$bg1Image_lgW  	= htmlspecialchars($this->params->get('bg1Image_lgW'));
$bg1Image_smW  	= htmlspecialchars($this->params->get('bg1Image_smW'));


$wsaCssFilename = strtolower(htmlspecialchars($this->params->get('wsaCssFilename')));
if ($wsaCssFilename > " ")
{$path_parts = pathinfo($wsaCssFilename);
if (path_parts['extension'] <> 'css'){$wsaCssFilename = $wsaCssFilename . '.css';};
}
else
{ $wsaCssFilename = 'template.min.' . $templatestyleid . '.css';}

$twbs_version 		= htmlspecialchars($this->params->get('twbs_version', '4'));
$wsaTime            = htmlspecialchars($this->params->get('wsaTime',''));
$wsaTime 			= strtr($wsaTime, array(' '=> 't', ':' => '' ));
$wsaNavbarExpand = htmlspecialchars($this->params->get('wsaNavbarExpand', 'navbar-expand-md'));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" prefix="og: http://ogp.me/ns#  fb: http://www.facebook.com/2008/fbml" >
<head>
<jdoc:include type="head" />
<?php
echo '<!-- base is ' . $this->getBase() .' $templatestyleid ='.$templatestyleid .'  Jversie  >=  4: ' . $joomlaverge4 , '. -->  ';

// Add extra metadata
$this->setMetaData( 'X-UA-Compatible', 'IE=edge', true ); // http-equiv = true 
$this->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
if ($joomlaverge4) { // Joomla 4 stylesheets and javascript via webassets
// Enable assets
$wa->usePreset('template.wsa_bootstrap')
   ->addInlineScript('jQuery(document).ready(function() {
  jQuery(\'a[rel*="lightbox"], a[data-wsmodal]\').magnificPopup({
type: \'image\'
, closeMarkup : \'<button title="%title%" type="button" class="mfp-close">&nbsp;</button>\'
});})',
['position' => 'after'],
[],
['magnificpopup']
);
// overrides defaults from joomla.asset.json for lower BS versions and styleid specific template style
// register overrides for older BS versions
switch ($twbs_version) {
//   case "5" : {
//       $wa->registerStyle('bootstrap.css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', ['version'=>'5.1.3'], ['integrity' => 'sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3', 'crossorigin' => 'anonymous'],[])
//       ->registerScript('bootstrap.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', ['version'=>'5.1.3'], ['integrity' => 'sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p', 'crossorigin' => 'anonymous', 'defer' => TRUE],[])
//       ;
//   }
//   break;
   case "4" :  {
       $wa->registerStyle('bootstrap.css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', ['version'=>'4.3.1'], ['integrity' => 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'crossorigin' => 'anonymous'],[])
       ->registerScript('popper.js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', ['version'=>'1.14.7'], ['integrity' => 'sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1', 'crossorigin' => 'anonymous', 'defer' => TRUE],[])
       ->registerScript('bootstrap.js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', ['version'=>'4.3.1'], ['integrity' => 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM', 'crossorigin' => 'anonymous', 'defer' => TRUE],['popper.js'])
       ;
   }
   break;
   case "3" : {
       $wa->registerStyle('bootstrap.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', ['version'=>'3.3.7'], ['integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous'],[])
       ->registerAndUseStyle('bootstrap.theme.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', ['version'=>'3.3.7'], ['integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous'],['bootstrap.css'])
       ->registerScript('bootstrap.js', 'jui/bootstrap.min.js', ['version'=>'3.3.7'], ['defer' => TRUE],['jquery'])
       ;
   }
}
 
$wa->registerStyle('template.wsa_bootstrap', $wsaCssFilename, ['version' => $wsaTime], [],['bootstrap.theme.css']);
// overrides end
} // end Joomla 4 up
else { // Joomla lower then 4
// stylesheets
$this->addStyleSheet('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' , array('version'=>'auto'), array('id'=>'googleapis-fonts.css'));
// bootstrap stylesheets van cdn
switch ($twbs_version) { 
case "5" :  {
    $attribs = array('id'=>'bootstrap.min.css', 'integrity' => 'sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3', 'crossorigin' => 'anonymous');
    $this->addStyleSheet('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array('version'=>'5.1.3'),  $attribs);
    }
break;
case "4" :  {
    $attribs = array('id'=>'bootstrap.min.css', 'integrity' => 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'crossorigin' => 'anonymous');
    $this->addStyleSheet('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array('version'=>'4.3.1'),  $attribs);
    }
break;
case "3" : {
$attribs = array('id'=>'bootstrap.min.css', 'integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u', 'crossorigin' => 'anonymous');
$this->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('version'=>'3.3.7'),  $attribs);
$attribs = array('id'=>'bootstrap-theme.min.css', 'integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp', 'crossorigin' => 'anonymous');
$this->addStyleSheet('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' , array('version'=>'3.3.7'), $attribs);
    }
}
// template stijl
$attribs = array('id'=>'template.css');
$this->addStyleSheet('templates/' . $this->template . '/css/' . $wsaCssFilename , array('version'=>$wsaTime), $attribs);

// Add JavaScript 

//HTMLHelper::_('jquery.framework');  // to be sure that jquery is loaded before dependent javascripts

switch ($twbs_version) {
case "5" :  {
    $this->addScript('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('version'=>'5.1.3'),
    array('id'=>'bootstrap.min.js', 'integrity' => 'sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p',   'crossorigin' => 'anonymous'));
    }
break;
case "4" : {
    $this->addScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('version'=>'1.14.7'),
    array('id'=>'popper.js', 'integrity' => 'sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1',   'crossorigin' => 'anonymous'));
    $this->addScript('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('version'=>'4.3.1'),
    array('id'=>'bootstrap.min.js', 'integrity' => 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM',   'crossorigin' => 'anonymous'));
    }
break;
case "3" :{
    $this->addScript('templates/' . $this->template . '/js/jui/bootstrap.min.js', array('version'=>'3.3.7'), 
	array('id'=>'bootstrap.min.js', 'defer'=>'defer'));
    }
}

$this->addScript($this->baseurl . '/templates/' . $this->template . '/js/magnificpopup/MagnificPopupV1-1-0.js', array('version'=>'1-1-0'), array('id'=>'MagnificPopupV1-1-0.js', 'defer'=>'defer'));
$this->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js', array('version'=>'auto'), array('id'=>'template.js', 'defer'=>'defer'));
	
$this->addScriptDeclaration('jQuery(document).ready(function() {
  jQuery(\'a[rel*="lightbox"], a[data-wsmodal]\').magnificPopup({
type: \'image\'
, closeMarkup : \'<button title="%title%" type="button" class="mfp-close">&nbsp;</button>\'
});})'); 

} // end Joomla lower than 4
// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$spanc = "span6  col-md-6" ;
	$spans = "span3  col-md-3";
}
elseif (!$this->countModules('position-7') && !$this->countModules('position-8'))
    
{
    $spanc = "span12  col-12";
}
else
{
	$spanc = "span8  col-md-8";
	$spans = "span4  col-md-4";
}
$hi_mods = ($this->countModules('position-0')? ' hipos0': '')
. ($this->countModules('icons')? ' hiicons': '')
. ($this->countModules('headerleft')? ' hihl': '')
. ($this->countModules('position-4')? ' hipos4': '')
. ($this->countModules('position-5')? ' hipos5': '')
. ($this->countModules('position-6')? ' hipos6': '')
;
$cnt_mods = ($this->countModules('position-1')? ' cntpos1': '')
. ($this->countModules('position-2')? ' cntpos2': '')
. ($this->countModules('position-3')? ' cntpos3': '')
. ($this->countModules('position-7')? ' cntpos7': '')
. ($this->countModules('position-8')? ' cntpos8': '')
. ($this->countModules('message')? ' cntmsg': ''); 
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

<div id="wrapper1">
		<!-- Begin Header-->
		<div class="header">
			<div class="header-inner container-content<?php echo $hi_mods; ?>">
				<?php if ($this->countModules('position-0')): ?>
				<div class="pos0 row">
					<jdoc:include type="modules" name="position-0" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos0-->
				<?php endif; ?>
 				<?php if(  $this->countModules('icons'))    : ?>
				<div id="icons" class="iconssm <?php  echo $wsaNavbarExpand;   ?> row">
					<jdoc:include type="modules" name="icons" />
				</div><!--End Icons-->   
				<?php endif; ?>
				<?php if(  $this->countModules('headerleft'))    : ?>
				<div id="headerleft ">
					<div class="inner d-flex justify-content-between row">
						<jdoc:include type="modules" name="headerleft"  />
					<div class="clearfix"></div>
					</div>
				</div><!--einde headerleft-->  
  				<?php endif; ?>
				<?php if ($this->countModules('position-4')): ?>
				<div class="pos4 row">
					<jdoc:include type="modules" name="position-4" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos4-->
				<?php endif; ?>
				<?php if ($this->countModules('position-5')): ?>
				<div class="pos5 row bigimage">
					<jdoc:include type="modules" name="position-5" style="none" />
					<div class="clearfix"></div>
				</div><!--End Bigimage-->
				<?php endif; ?>
				<?php if ($this->countModules('position-6')): ?>
				<div class="pos6 row">
					<jdoc:include type="modules" name="position-6" style="none" />
					<div class="clearfix"></div>
				</div><!--End Pos6-->
				<?php endif; ?>
				<div class="clearfix"></div>
			</div><!--End Header-Inner-->
		</div><!--End Header-->
		<!-- Begin Container content-->
		<div class="container-content<?php echo $cnt_mods; ?>">
		    	<?php if ($this->countModules('position-1')): ?>
	            	    <jdoc:include type="modules" name="position-1" style="none" />
		    	<?php endif; ?>
			<div class="row">
				<?php if ($this->countModules('position-8')): ?>
				<div id="sidebarleft" class="pos8 <?php echo $spans;?>">
					<jdoc:include type="modules" name="position-8" style="well" /><!--End Position-8-->
				</div><!--End Sidebar Left-->
				<?php endif; ?>
				<div id="content" class="<?php echo $spanc;?>">
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
				<div id="sidebarright" class="pos7 <?php echo $spans;?>">
					<jdoc:include type="modules" name="position-7" style="well" /><!--End Position-7-->
				</div><!--End Sidebar Right-->
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
