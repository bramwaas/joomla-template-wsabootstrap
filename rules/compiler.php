<?php
/**
 * @package Joomla.Site
 * @subpackage Templates.dna
 *
 * @copyright Copyright (C) 2016 Bram Waasdorp. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
/* regel voor validatie type compiler, bedoeld om samenstellen en compileren Less bestanden uit te voeren vlak voor
   de save  
v 23-2-2016
v 20-3-2016 bootstrap 3
V 6-4-2016 magnific popup
V 24-4-2016 dropdown menu in apart .less bestand
V 16-5-2016 kleuren dropdownmenu variabel gemaakt.
V 18-5-2016 compiler uit template.php gebruikt, deze werkt beter met mixins en functies
V 19-5-2016 kleine aanpassing instellingen compiler
V 22-5-2016 brandImage toegevoegd
V 27-5-2016 kleuren navbar toggle button
V 29-5-2016 breakpointmobile verwijderd.
V juni 2016 overgang naar SASS (scss)
v 12-6-2016 fout in bg1Pos (weer) opgelost
v 15-7-2016 grid.scss toegevoegd
v 28-12-2016 alle backgroundimages via html niet meer css, wel twee groottes
	*/
 
defined('_JEXEC') or die('caught by _JEXEC');
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Server;
 
class WsaFormRuleCompiler extends JFormRule
/* voorbeeld eenvoudigste validatie dmv regexp
 uitgebreider gaat met functie test die ik hier wel ga gebruiken.
{
    protected $regex = '[0-9]';
}
*/

{ /* begin WsaFormRuleCompiler voert validatie wsa.compiler uit */

public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
    {

 $templateid =  JURI::getInstance ()->getVar('id');
 $app = JFactory::getApplication();
 $currentpath = realpath(__DIR__ ) ;
 $home = JFactory::getApplication()->input->get('jform', '', 'array')['home'];
 $params = JFactory::getApplication()->input->get('jform', '', 'array')['params'];


if  (htmlspecialchars($params['compile']) == '1')

{ /* creeren en compileren */

// scss compiler van leafo http://leafo.github.io/scssphp/
require_once "leafo/scss.inc.php";


$scss = new Compiler();

if ( htmlspecialchars($params["compress"]) == "1")
{
$scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
}
else
{  // voor debug netter formatteren en commentaren behouden. 
 $scss->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
// $scss->setLineNumberStyle(Compiler::LINE_COMMENTS);
}
$server = new Server($currentpath. '/../scss', null, $scss);
//$server->serve();



// einde initialisatie compiler


// get params

$gplusProfile   = htmlspecialchars($params['gplusProfile']);
$itemVideoHeight= htmlspecialchars($params['itemVideoHeight']);
$itemLeadHeight = htmlspecialchars($params['itemLeadHeight']);
$itemLeadWidth  = htmlspecialchars($params['itemLeadWidth']);
$itemLeadMargin = htmlspecialchars($params['itemLeadMargin']);
$itemHeight    	= htmlspecialchars($params['itemHeight']);
$itemWidth    	= htmlspecialchars($params['itemWidth']);
$itemMargin    	= htmlspecialchars($params['itemMargin']);

$hlMarginTop    = htmlspecialchars($params['hlMarginTop']);
$hlMarginLeft   = htmlspecialchars($params['hlMarginLeft']);
if ($hlMarginLeft > " " ) {} else { $hlMarginLeft = 0; }
$hlWidth    	= htmlspecialchars($params['hlWidth']);
$hlHeight    	= htmlspecialchars($params['hlHeight']);
$hlMarginBottom = htmlspecialchars($params['hlMarginBottom']);
$iconsWidth    	= htmlspecialchars($params['iconsWidth']);
$iconsPosLeft   = htmlspecialchars($params['iconsPosLeft']);
$iconsPosTop    = htmlspecialchars($params['iconsPosTop']);
$footerWidth    = htmlspecialchars($params['footericonsWidth']);
$footerPosLeft  = htmlspecialchars($params['footerPosLeft']);
$footerPosBottom	= htmlspecialchars($params['footerPosBottom']);

$menuType 		= htmlspecialchars($params['menuType']); 
$menuColor 		= htmlspecialchars($params['menuColor']);
$menuActiveColor 	= htmlspecialchars($params['menuActiveColor']);
$menuDisabledColor 	= htmlspecialchars($params['menuDisabledColor']);
$menuBgColor 		= htmlspecialchars($params['menuBgColor']);
$menuActiveBgColor 	= htmlspecialchars($params['menuActiveBgColor']);

$iconsMobileLeft = '';
$iconsMobileWidth =  ''; 

$contentPosLeft	= htmlspecialchars($params['contentPosLeft']);
$contentPosRight	= htmlspecialchars($params['contentPosRight']);
$contentPosTop  = htmlspecialchars($params['contentPosTop']);
$marginLeftRight	= htmlspecialchars($params['marginLeftRight']);

if ( $hlWidth > " " and $hlWidth < 40) {
$iconsMobileLeft = $hlWidth;
$iconsMobileWidth =  100 - $hlWidth; 
}

$fgColor    	= htmlspecialchars($params['fgColor']);

$brandImage    	= htmlspecialchars($params['brandImage']); // url
$brandSize    	= htmlspecialchars($params['brandSize']); // auto  <width> % or px 
$brandWidth    	= htmlspecialchars($params['brandWidth']); // number
$brandDim       = 'px';
if ($brandImage > ' ' and strtolower(substr ( $brandImage , 0 , 7 )) == 'images/' ) 
 {$brandImage = '/' . $brandImage;}; 
if ($brandImage > ' ') $brandImage = 'url("' . $brandImage . '")';
if ($brandImage == '%')  {$brandDim = '%';};
if ($brandWidth > ' ') {$brandWidth = $brandWidth.$brandDim;} else {$brandWidth = 'auto';};

$wsaCustomSCSS    	= htmlspecialchars($params['wsaCustomSCSS']); // url
if ($wsaCustomSCSS == '-1' ) {$wsaCustomSCSS = '';};
if ($wsaCustomSCSS > ' ' and strtolower(substr ( $wsaCustomSCSS , 0 , 7 )) == 'images/' ) 
 {$wsaCustomSCSS = '/' . $wsaCustomSCSS;}; 

 

$bg0Image    	= htmlspecialchars($params['bg0Image']);
if ($bg0Image > ' ' and strtolower(substr ( $bg0Image , 0 , 7 )) == 'images/' ) 
 {$bg0Image = '/' . $bg0Image;}; 
$bg0Image_lg    	= htmlspecialchars($params['bg0Image_lg']);
if ($bg0Image_lg > ' ' and strtolower(substr ( $bg0Image_lg , 0 , 7 )) == 'images/' )
 {$bg0Image_lg = '/' . $bg0Image_lg;};
if ($bg0Image > ' ') $bg0Image = 'url("' . $bg0Image . '")'; else $bg0Image = 'none';
if ($bg0Image_lg > ' ') $bg0Image_lg = 'url("' . $bg0Image_lg . '")'; else $bg0Image_lg = 'none';
 
$bg0Width    	= htmlspecialchars($params['bg0Width']); // number
$bg0Pos    		= htmlspecialchars($params['bg0Pos']); //  % or px 
$bg0Top      	= htmlspecialchars($params['bg0Top']); // number
$bg0Left      	= htmlspecialchars($params['bg0Left']); // number
$bg0Color    	= htmlspecialchars($params['bg0Color']); // name or hex
$bg0Dim         = 'px';
$bg0DimPos      = 'px';
if ($bg0Pos ==  '%')  {$bg0Dim = '%'; $bg0DimPos = '%';};
if ($bg0Width > ' ') {$bg0Width = $bg0Width.$bg0Dim;} else {$bg0Width = 'auto';};

if ($bg0Top > ' '  ) {$bg0Top = $bg0Top.$bg0DimPos;} else {$bg0Top = 'auto';};
if  ($bg0Left > ' ') 
    {$bg0Left = $bg0Left.$bg0DimPos;
     if ($bg0Top != 'auto'  ) {$bg0Pos = $bg0Left.' '.$bg0Top;}  else {$bg0Pos = $bg0Left;}}
 else
   {$bg0Left = 'auto';
    if ($bg0Top != 'auto'  ) {$bg0Pos = '50% '.$bg0Top;} else {$bg0Pos = '';}}

$bg1Image    	= htmlspecialchars($params['bg1Image']);
if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' ) 
 {$bg1Image = '/' . $bg1Image;};
$bg1Image_lg    	= htmlspecialchars($params['bg1Image_lg']);
if ($bg1Image_lg > ' ' and strtolower(substr ( $bg1Image_lg , 0 , 7 )) == 'images/' ) 
 {$bg1Image_lg = '/' . $bg1Image_lg;};
if ($bg1Image > ' ') $bg1Image = 'url("' . $bg1Image . '")'; else $bg1Image = 'none';
if ($bg1Image_lg > ' ') $bg1Image_lg = 'url("' . $bg1Image_lg . '")'; else $bg1Image_lg = 'none';
 $bg1Width    	= htmlspecialchars($params['bg1Width']); // number
$bg1Pos    		= htmlspecialchars($params['bg1Pos']); //  % or px 
$bg1Top      	= htmlspecialchars($params['bg1Top']); // number
$bg1Left      	= htmlspecialchars($params['bg1Left']); // number
$bg1Color    	= htmlspecialchars($params['bg1Color']); // name or hex
$bg1Dim         = 'px';
$bg1DimPos      = 'px';
if ($bg1Pos ==  '%')  {$bg1Dim = '%'; $bg1DimPos = '%';};
if ($bg1Width > ' ') {$bg1Width = $bg1Width.$bg1Dim;} else {$bg1Width = 'auto';};

if ($bg1Top > ' '  ) {$bg1Top = $bg1Top.$bg1DimPos;} else {$bg1Top = 'auto';};
if  ($bg1Left > ' ') 
    {$bg1Left = $bg1Left.$bg1DimPos;
     if ($bg1Top != 'auto'  ) {$bg1Pos = $bg1Left.' '.$bg1Top;}  else {$bg1Pos = $bg1Left;}}
 else
   {$bg1Left = 'auto';
	if ($bg1Top != 'auto'  ) {$bg1Pos = '50% '.$bg1Top;} else {$bg1Pos = '';}}

$bg2Image    	= htmlspecialchars($params['bg2Image']);
if ($bg2Image > ' ' and strtolower(substr ( $bg2Image , 0 , 7 )) == 'images/' ) 
 {$bg2Image = '/' . $bg2Image;}; 
$bg2Image_lg    	= htmlspecialchars($params['bg2Image_lg']);
if ($bg2Image_lg > ' ' and strtolower(substr ( $bg2Image_lg , 0 , 7 )) == 'images/' ) 
 {$bg2Image_lg = '/' . $bg2Image_lg;}; 
if ($bg2Image > ' ') $bg2Image = 'url("' . $bg2Image . '")'; else $bg2Image = 'none';
if ($bg2Image_lg > ' ') $bg2Image_lg = 'url("' . $bg2Image_lg . '")'; else $bg2Image_lg = 'none';
 $bg2Width    	= htmlspecialchars($params['bg2Width']); // number
$bg2Pos     	= htmlspecialchars($params['bg2Pos']); //  % or px 
$bg2Top      	= htmlspecialchars($params['bg2Top']); // number
$bg2Left      	= htmlspecialchars($params['bg2Left']); // number
$bg2Color    	= htmlspecialchars($params['bg2Color']); // name or hex
$bg2Dim         = 'px';
$bg2DimPos      = 'px';
if ($bg2Pos ==  '%')  {$bg2Dim = '%'; $bg2DimPos = '%';};
if ($bg2Width > ' ') {$bg2Width = $bg2Width.$bg2Dim;} else {$bg2Width = 'auto';};

if ($bg2Top > ' '  ) {$bg2Top = $bg2Top.$bg2DimPos;} else {$bg2Top = 'auto';};
if  ($bg2Left > ' ') 
    {$bg2Left = $bg2Left.$bg2DimPos;
     if ($bg2Top != 'auto'  ) {$bg2Pos = $bg2Left.' '.$bg2Top;}  else {$bg2Pos = $bg2Left;}}
 else
   {$bg2Left = 'auto';
   if ($bg2Top != 'auto'  ) {$bg2Pos = '50% '.$bg2Top;} else {$bg2Pos = '';}}



try
 { /*begin try */

/* opslaan style parameters in style.scss bestanden */

/* variabelen */
$tv_file =fopen($currentpath. '/../scss/style' . $templateid . '.var.scss', "w+");


/* less files creeeren en compileren naar .css */

fwrite($tv_file, "// style variables \n");
fwrite($tv_file, "// generated " . date("c")  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");

fwrite($tv_file, "//  "  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");
if ($gplusProfile > ' '  ) 	fwrite($tv_file, '$gplusProfile:              "'  . $gplusProfile .  "\";\n");

if ($fgColor > ' '  ) fwrite($tv_file, '$fgColor:          '  . $fgColor .  ";\n");

if ($brandImage > ' ' ) fwrite($tv_file, '$brandImage:        ' . $brandImage .  ";\n");
if ($brandSize > ' '  ) fwrite($tv_file, '$brandSize:         ' . $brandSize . ";\n");
if ($brandWidth > ' ' ) fwrite($tv_file, '$brandWidth:        ' . $brandWidth . ";\n");


if ($bg0Image > ' ' ) fwrite($tv_file, '$bg0Image:          ' . $bg0Image .  ";\n");
if ($bg0Image_lg > ' ' ) fwrite($tv_file, '$bg0Image_lg:       ' . $bg0Image_lg .  ";\n");
if ($bg0Width > ' ' ) fwrite($tv_file, '$bg0Width:          ' . $bg0Width . ";\n");
if ($bg0Pos > ' '   ) fwrite($tv_file, '$bg0Pos:            ' . $bg0Pos . ";\n");
if ($bg0Top > ' '  )  fwrite($tv_file, '$bg0Top:            ' . $bg0Top . ";\n");
if ($bg0Left > ' '  ) fwrite($tv_file, '$bg0Left:           ' . $bg0Left . ";\n");
if ($bg0Color > ' ' ) fwrite($tv_file, '$bg0Color:          ' . $bg0Color . ";\n");

if ($bg1Image > ' ' ) fwrite($tv_file, '$bg1Image:          ' . $bg1Image .  ";\n");
if ($bg1Image_lg > ' ' ) fwrite($tv_file, '$bg1Image_lg:       ' . $bg1Image_lg .  ";\n");
if ($bg1Width > ' ' ) fwrite($tv_file, '$bg1Width:          ' . $bg1Width . ";\n");
if ($bg1Pos > ' '   ) fwrite($tv_file, '$bg1Pos:            ' . $bg1Pos . ";\n");
if ($bg1Top > ' '  )  fwrite($tv_file, '$bg1Top:            ' . $bg1Top . ";\n");
if ($bg1Left > ' '  ) fwrite($tv_file, '$bg1Left:           ' . $bg1Left . ";\n");
if ($bg1Color > ' ' ) fwrite($tv_file, '$bg1Color:          ' . $bg1Color . ";\n");

if ($bg2Image > ' ' ) fwrite($tv_file, '$bg2Image:          ' . $bg2Image .  ";\n");
if ($bg2Image_lg > ' ' ) fwrite($tv_file, '$bg2Image_lg:       ' . $bg2Image_lg .  ";\n");
if ($bg2Width > ' ' ) fwrite($tv_file, '$bg2Width:          ' . $bg2Width . ";\n");
if ($bg2Pos > ' '   ) fwrite($tv_file, '$bg2Pos:            ' . $bg2Pos . ";\n");
if ($bg2Top > ' '  )  fwrite($tv_file, '$bg2Top:            ' . $bg2Top . ";\n");
if ($bg2Left > ' '  ) fwrite($tv_file, '$bg2Left:           ' . $bg2Left . ";\n");
if ($bg2Color > ' ' ) fwrite($tv_file, '$bg2Color:          ' . $bg2Color . ";\n");

if ($hlMarginTop > ' '  ) 	fwrite($tv_file, '$hlMarginTop:       '  . $hlMarginTop .  "%;\n");
if ($hlMarginLeft > ' '  ) 	fwrite($tv_file, '$hlMarginLeft:      '  . $hlMarginLeft .  "%;\n");
if ($hlWidth > ' '  ) 		fwrite($tv_file, '$asHeadLeftWidth:   '  . $hlWidth .  "%;\n");				
if ($hlHeight > ' '  ) 		fwrite($tv_file, '$hlHeight:          '  . $hlHeight .  "%;\n");
if ($hlMarginBottom > ' '  ) 	fwrite($tv_file, '$hlMarginBottom:    '  . $hlMarginBottom .  "%;\n");
if ($iconsWidth > ' '  ) 	fwrite($tv_file, '$iconsWidth:        '  . $iconsWidth .  "%;\n");
if ($iconsPosLeft > ' '  ) 	fwrite($tv_file, '$iconsPosLeft:      '  . $iconsPosLeft .  "%;\n");
if ($iconsPosTop > ' '  ) 	fwrite($tv_file, '$iconsPosTop:       '  . $iconsPosTop .  "%;\n");
if ($iconsMobileLeft > ' '  ) 	fwrite($tv_file, '$iconsMobileLeft:   '  . $iconsMobileLeft .  "%;\n");
if ($iconsMobileWidth > ' '  ) 	fwrite($tv_file, '$iconsMobileWidth:  '  . $iconsMobileWidth .  "%;\n");

if ($menuColor > ' '  ) { 	fwrite($tv_file, '$menuColor:           '  . $menuColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarlighter:    lighten($menuColor,30%)' .  ";\n");
			  	fwrite($tv_file, '$graynavbardarker:     $menuColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-color: $menuColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-color: $menuColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-hover-color: darken($menuColor, 10%)' .  ";\n");
};
if ($menuActiveColor > ' '  ) { fwrite($tv_file, '$menuActiveColor:     '  . $menuActiveColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarfg:         $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-active-color: $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-active-link-hover-border-color: $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-icon-bar-bg: $menuActiveColor' .  ";\n");
				                  
};
if ($menuDisabledColor > ' '  ) { fwrite($tv_file, '$menuDisabledColor: '  . $menuDisabledColor .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-disabled-color: $menuDisabledColor' .  ";\n");
};
if ($menuBgColor > ' '  ) { 	fwrite($tv_file, '$menuBgColor:         '  . $menuBgColor .  ";\n");
			  	fwrite($tv_file, '$navbar-default-bg:    $menuBgColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-border: darken($navbar-default-bg, 6.5%)' .  ";\n");
			  	fwrite($tv_file, '$dropdown-bg:    $menuBgColor' .  ";\n");
			  	fwrite($tv_file, '$dropdown-border: darken($navbar-default-bg, 6.5%)' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-border-color: $navbar-default-border' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-border-color: darken($navbar-default-bg, 6.5%)' .  ";\n");
};
if ($menuActiveBgColor > ' '  ) { fwrite($tv_file, '$menuActiveBgColor: '  . $menuActiveBgColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarbg:         $menuActiveBgColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-active-bg: $menuActiveBgColor' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-link-hover-border-color: darken($navbar-default-link-active-bg, 6.5%)' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-hover-bg: $menuActiveBgColor' .  ";\n");
};

/* overgenomen uit asha-s werkt mogelijk (nog) niet */
if ($showTitle > ' '  ) 	fwrite($tv_file, '$showTitle:         '  . $showTitle .  ";\n");
if ($tagItemTitleDisplay > ' '  ) fwrite($tv_file, '$tagItemTitleDisplay: '  . $tagItemTitleDisplay .  ";\n");
if ($marginLeftRight > ' '  ) 	{
				fwrite($tv_file, '$asMarginStd:       '  . $marginLeftRight .  "%;\n");
				fwrite($tv_file, '$marginArea:        '  . ($marginLeftRight / 2) .  "%;\n");
};
if ($itemVideoHeight > ' '  ) 	fwrite($tv_file, '$wsaVideoHeight:     '  . $itemVideoHeight .  "%;\n");
  
if ($footerWidth > ' '  ) 	fwrite($tv_file, '$footerWidth:       '  . $footerWidth .  "%;\n");
if ($footerPosLeft > ' '  ) 	fwrite($tv_file, '$footerPosLeft:     '  . $footerPosLeft .  "%;\n");
if ($footerPosBottom > ' '  ) 	fwrite($tv_file, '$footerPosBottom:   '  . $footerPosBottom .  "%;\n");
/* einde overgenomen uit asha-s werkt mogelijk (nog) niet */

/* einde variabelen */
fclose($tv_file);

$st_file =fopen($currentpath. '/../scss/style' . $templateid . '.scss', "w+");
/* .scss file dat variabelen gebruikt */

fwrite($st_file, "// style" . $templateid .  ".scss \n");
fwrite($st_file, "// generated " . date("c")  . "\n//\n");
// standaard bootstrap variables mixins etc.
fwrite($st_file, '@import "variables.scss";' . "\n");
fwrite($st_file, '@import "mixins/reset-filter.scss";' . "\n"); 
fwrite($st_file, '@import "mixins/vendor-prefixes.scss";' . "\n"); 
fwrite($st_file, '@import "mixins/gradients.scss";' . "\n");  
fwrite($st_file, '@import "mixins/grid.scss";' . "\n");  
// standaard bootstrap variables mixins etc. einde
//fwrite($st_file, '@import "system.scss";' . "\n");
//fwrite($st_file, '@import "general.scss";' . "\n");
fwrite($st_file, '@import "magnificpopup.variables.scss";' . "\n");
fwrite($st_file, '@import "template_variables.scss";' . "\n");
//fwrite($st_file, '@import "flickr_badge.scss";' . "\n");
//fwrite($st_file, '@import "joomla_update_icons.scss";' . "\n");

if ($background > ' '  )
{ 	$pos1 = stripos($background, ".css");
	if ($pos1 > 0)
	{
    $background = substr_replace($background, '.scss', $pos1, 4) ;
	}
	fwrite($st_file, '@import "'  . $background .  "\";\n");
}
fwrite($st_file, '@import "style' . $templateid . '.var.scss";' . "\n");
fwrite($st_file, '@import "magnificpopup.scss";' . "\n");
fwrite($st_file, '@import "template_dropdown.scss";' . "\n");
fwrite($st_file, '@import "template_css.scss";' . "\n");

fwrite($st_file, "body {\n");
if ($fgColor > " "  ) fwrite($st_file, "color:  $fgColor ;\n");
if ($bg0Color > " " ) fwrite($st_file, "background-color:  $bg0Color;\n");
fwrite($st_file, "}\n");

fwrite($st_file, "#wrapper, \nbody>div.container {\n");
if ($bg1Color > " " ) fwrite($st_file, "background-color:  $bg1Color;\n");
fwrite($st_file, "}\n");

if ($menuType == 'transparent') 
{
fwrite($st_file, "\n.navbar,\n.navbar-inner,\n.nav-tabs,\n.breadcrumb\n{\n");
fwrite($st_file, "background-color: transparent;\n");
fwrite($st_file, "background-image: none;\n");	
fwrite($st_file, "border-style: none;\n");
fwrite($st_file, "}\n");
}
if ($wsaCustomSCSS > ' ') fwrite($st_file, '@import "'.JPATH_ROOT.'/images/scss/'.$wsaCustomSCSS.'";'. "\n");


/* einde .scss file dat variabelen gebruikt */
fclose($st_file);

/* einde opslaam style parameters in style.scss bestanden */
/* scss files compileren naar .css */

 $server->compileFile($currentpath. '/../scss/style' . $templateid . '.scss', $currentpath.'/../css/template.min.' . $templateid . '.css');


if ($home == 1 ) 
 {/* niet kunnen vinden van templateid bij root (lijkt inmiddels opgelost te zijn)*/ 
  $server->compileFile($currentpath. '/../scss/style' . $templateid . '.scss', $currentpath.'/../css/template.min.'  . '.css');
  /* ivm &tmpl=component */
  $server->compileFile($currentpath. '/../scss/style' . $templateid . '.scss', $currentpath.'/../css/template'  . '.css');
}

/* einde les files compileren naar .css */
/* "Compileren LESS geslaagd." "COM_TEMPLATES_COMPILE_SUCCESS" */
$app->enqueueMessage("Compile SCSS succes.", 'message');


/* end try */
}
catch (Exception $e)
{
 $app->enqueueMessage($e->getMessage(), 'error');
 return false;
}

/* end creeren en compileren */
}


return true;
/* eind test */
}
/* eind WsaFormRuleCompiler */
}

?>
