<?php
/**
 * @package Joomla.Site
 * @subpackage Templates.dna
 *
 * @copyright Copyright (C) 2016 - 2024 Bram Waasdorp. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
/* regel voor validatie type compiler, bedoeld om samenstellen en compileren Less bestanden uit te voeren vlak voor
   de save  
v 23-2-2016
v 20-3-2016 bootstrap 3
v 7-1-2018 J3.8 j4 namespace
v 19-1-2019 custom scss
v 20-1-2019 wsaNavbarRightWidth
v 25-1-2019 bootstrap 4 .scss files toegevoegd ter voorbereiding op uitbreiding breakpoints
v 30-1-2019 uitbreiding breakpoints voorwaardelijk in style<...>.scss schrijven ipv in apart .scss file.
V 2-2-2019 nieuwe versie van Leafo\ScssPhp\Compiler 0.7.6
V 6-2-2019 navbar kleuren default bs4 ipv 3
v 7-2 2019 nog maar 1 set achtergondafbeeldingen en 2 kleuren.
v 10-2-2019 naam veranderd en enkele aanpassingen voor v4 naam van het bestand moet compiler.php blijven, omdat deze gemoemd wordt in validat clausule van compiler veld
v 11-2-2019 params as an object
v 20-3-2019 border en active link colors nav-bar
v 26-12-2021 added Joomla version info to use J4 specific code.
2023-12-07 resolved Unknown constant path_parts (is var $path_parts). 
2024-10-03 v2.2.0 New scss compiler scssphp/scssphp 1.13.0 and server scssphp/server 1.1.0 as continuation of leafo/scssphp.
    Remove Bootstrap 3, use latest versions 5.3.3 and 4.6.2 of BS 5 and 4. Remove extra breakpoints
2024-12-20 v2.3.0 inheritable    
	*/
 
defined('_JEXEC') or die('caught by _JEXEC');
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\Server\Server;

use Joomla\CMS\Factory;   
use Joomla\CMS\Form\FormRule;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Version;

 
class WsaFormRuleCompiler extends FormRule
/* voorbeeld eenvoudigste validatie dmv regexp
 uitgebreider gaat met functie test die ik hier wel ga gebruiken.
{
    protected $regex = '[0-9]';
}
*/

{ /* begin WsaFormRuleCompiler voert validatie wsa.compiler uit */

//public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)

    /**
     * Method to test the value.
     *
     * @param   \SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
     * @param   mixed              $value    The form field value to validate.
     * @param   string             $group    The field name group control value. This acts as as an array container for the field.
     *                                       For example if the field has name="foo" and the group value is set to "bar" then the
     *                                       full field name would end up being "bar[foo]".
     * @param   ArrayAccess        $input    An optional Registry object with the entire data set to validate against the entire form.
     * @param   Form               $form     The form object for which the field is being tested.
     *
     * @return  boolean  True if the value is valid, false otherwise.
     *
     * @since   1.7.0
     * @throws  \UnexpectedValueException if rule is invalid.
     */
    public function test(\SimpleXMLElement $element, $value, $group = null,  $input = null, Form $form = null)
    
    {
// $joomlaverge4 = (version_compare(JVERSION, '4.0', '>='));
        
$app = Factory::getApplication();
$templatestyleid = $input->get('id');
$prr = print_r($input, true); 
$assetPath = (($input->get('inheritable') || !empty($input->get('inheritable'))) ? JPATH_PUBLIC . '/media/templates/site/' : JPATH_THEMES . '/') . $input->get('template');

$home = $input->get('home');
$params = $input->get('params'); // stdobject params are properties.

if  (htmlspecialchars($value) == '1')

{ /* creeren en compileren */
    // scss compiler and server by scssphp https://scssphp.github.io/scssphp/
    require_once "scssphp/scss.inc.php";
    require_once "server/server.inc.php";

$scss = new Compiler();

if ( htmlspecialchars($params->compress) == "1")
{
    $scss->setOutputStyle (\ScssPhp\ScssPhp\OutputStyle::COMPRESSED);
}
else
{  // voor debug netter formatteren en commentaren behouden.
    $scss->setOutputStyle (\ScssPhp\ScssPhp\OutputStyle::EXPANDED);
$scss->setSourceMap(Compiler::SOURCE_MAP_INLINE);
}
$server = new Server($assetPath. '/scss', null, $scss);

// einde initialisatie compiler

// get params

$gplusProfile   = htmlspecialchars($params->gplusProfile);
$twbs_version   =  (empty($params->twbs_version)) ? '5' : htmlspecialchars($params->twbs_version);
$itemVideoHeight= htmlspecialchars($params->itemVideoHeight);
$itemLeadHeight = htmlspecialchars($params->itemLeadHeight);
$itemLeadWidth  = htmlspecialchars($params->itemLeadWidth);
$itemLeadMargin = htmlspecialchars($params->itemLeadMargin);
$itemHeight    	= htmlspecialchars($params->itemHeight);
$itemWidth    	= htmlspecialchars($params->itemWidth);
$itemMargin    	= htmlspecialchars($params->itemMargin);

$hlMarginTop    = htmlspecialchars($params->hlMarginTop);
$hlMarginLeft   = (empty($hlMarginLeft)) ? 0 : htmlspecialchars($params->hlMarginLeft);
$hlWidth    	= htmlspecialchars($params->hlWidth);
$hlHeight    	= htmlspecialchars($params->hlHeight);
$hlMarginBottom = htmlspecialchars($params->hlMarginBottom);
$iconsWidth    	= htmlspecialchars($params->iconsWidth);
$iconsPosLeft   = htmlspecialchars($params->iconsPosLeft);
$iconsPosTop    = htmlspecialchars($params->iconsPosTop);
$wsaIconsFlex   = htmlspecialchars($params->wsaIconsFlex);
$wsaDesktopExpand = htmlspecialchars($params->wsaDesktopExpand); 
$wsaNavbarRightWidth = htmlspecialchars($params->wsaNavbarRightWidth);
$footerWidth    = htmlspecialchars($params->footericonsWidth);
$footerPosLeft  = htmlspecialchars($params->footerPosLeft);
$footerPosBottom	= htmlspecialchars($params->footerPosBottom);

$menuType 		= htmlspecialchars($params->menuType); 
$menuColor 		= htmlspecialchars($params->menuColor);
$menuActiveColor 	= htmlspecialchars($params->menuActiveColor);
$menuDisabledColor 	= htmlspecialchars($params->menuDisabledColor);
$menuBgColor 		= htmlspecialchars($params->menuBgColor);
$menuActiveBgColor 	= htmlspecialchars($params->menuActiveBgColor);

$iconsMobileLeft = '';
$iconsMobileWidth =  ''; 

$contentPosLeft	= htmlspecialchars($params->contentPosLeft);
$contentPosRight	= htmlspecialchars($params->contentPosRight);
$contentPosTop  = htmlspecialchars($params->contentPosTop);
$marginLeftRight	= htmlspecialchars($params->marginLeftRight);

if ( $hlWidth > " " and $hlWidth < 40) {
$iconsMobileLeft = $hlWidth;
$iconsMobileWidth =  100 - $hlWidth; 
}

$fgColor    	= htmlspecialchars($params->fgColor);

$brandImage    	= htmlspecialchars($params->brandImage); // url
$brandSize    	= htmlspecialchars($params->brandSize); // auto  <width> % or px 
$brandWidth    	= htmlspecialchars($params->brandWidth); // number
$brandDim       = 'px';
//if ($brandImage > ' ' and strtolower(substr ( $brandImage , 0 , 7 )) == 'images/' ) 
// {$brandImage = '/' . $brandImage;}; 
if ($brandImage > ' ') $brandImage = 'url("' . $brandImage . '")';
if ($brandImage == '%')  {$brandDim = '%';};
if ($brandWidth > ' ') {$brandWidth = $brandWidth.$brandDim;} else {$brandWidth = 'auto';};

$wsaCustomSCSS    	= htmlspecialchars($params->wsaCustomSCSS); // url
if ($wsaCustomSCSS == '-1' ) {$wsaCustomSCSS = '';};
if ($wsaCustomSCSS > ' ' and strtolower(substr ( $wsaCustomSCSS , 0 , 7 )) == 'images/' ) 
 {$wsaCustomSCSS = '/' . $wsaCustomSCSS;}; 
 
$wsaCssFilename = strtolower(htmlspecialchars($params->wsaCssFilename));
 if ($wsaCssFilename > " ")
 {$path_parts = pathinfo($wsaCssFilename);
 if ($path_parts['extension'] <> 'css'){$wsaCssFilename = $wsaCssFilename . '.css';};
 }
 else
 { $wsaCssFilename = 'template.min.' . $templatestyleid . '.css';}

// $wsaBreakpointes =  htmlspecialchars($params->wsaBreakpointes);
// $wsaContaineres = $wsaBreakpointes;
// $wsaBreakpointxxl = htmlspecialchars($params->wsaBreakpointxxl);
// $wsaContainerxxl = htmlspecialchars($params->wsaContainerxxl);
// if (! $wsaContainerxxl) {$wsaContainerxxl = $wsaBreakpointxxl; }
// $wsaBreakpointxxxl = htmlspecialchars($params->wsaBreakpointxxxl);
// $wsaContainerxxxl = htmlspecialchars($params->wsaContainerxxxl);
// if (! $wsaContainerxxxl) {$wsaContainerxxxl = $wsaBreakpointxxxl; }
  
if (strpos($menuType, 'navbar-dark') !== false)
{$navbartheme = 'navbar-dark';}
else
{$navbartheme = 'navbar-light';}
if (strpos($menuType, 'bg-dark') !== false)
{$navbarbg = 'bg-dark';}
else
{$navbarbg = 'bg-light';}




$bg0Color    	= htmlspecialchars($params->bg0Color); // name or hex

$bg1Image    	= htmlspecialchars($params->bg1Image); 
//if ($bg1Image > ' ' and strtolower(substr ( $bg1Image , 0 , 7 )) == 'images/' )  {$bg1Image = '/' . $bg1Image;};
if ($bg1Image > ' ') $bg1Image = 'url("' . $bg1Image . '")'; else $bg1Image = 'none';
$bg1Image_lg    	= htmlspecialchars($params->bg1Image_lg);
//if ($bg1Image_lg > ' ' and strtolower(substr ( $bg1Image_lg , 0 , 7 )) == 'images/' )  {$bg1Image_lg = '/' . $bg1Image_lg;};
if ($bg1Image_lg > ' ') $bg1Image_lg = 'url("' . $bg1Image_lg . '")'; else $bg1Image_lg = 'none';
$bg1Breakpoint_lg    	= htmlspecialchars($params->bg1Breakpoint_lg);
$bg1Image_sm    	= htmlspecialchars($params->bg1Image_sm);
//if ($bg1Image_sm > ' ' and strtolower(substr ( $bg1Image_sm , 0 , 7 )) == 'images/' ) {$bg1Image_sm = '/' . $bg1Image_sm;};
if ($bg1Image_sm > ' ') $bg1Image_sm = 'url("' . $bg1Image_sm . '")'; else $bg1Image_sm = 'none';
$bg1Breakpoint_sm    	= htmlspecialchars($params->bg1Breakpoint_sm);

$bg1Width    	= htmlspecialchars($params->bg1Width); // number
$bg1Pos    		= htmlspecialchars($params->bg1Pos); //  % or px 
$bg1Top      	= htmlspecialchars($params->bg1Top); // number
$bg1Left      	= htmlspecialchars($params->bg1Left); // number
$bg1Color    	= htmlspecialchars($params->bg1Color); // name or hex
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


try
 { /*begin try */

/* opslaan style parameters in style.scss bestanden */

/* variabelen */
$tv_file =fopen($assetPath .'/scss/style' . $templatestyleid . '.var.scss', "w+");


/* scss files creeeren en compileren naar .css */

fwrite($tv_file, "// style variables \n");
fwrite($tv_file, "// generated " . date("c")  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");

fwrite($tv_file, "//  "  . "\n//\n");
fwrite($tv_file, "//  "  . "\n//\n");

if ($twbs_version > ' '  ) 	fwrite($tv_file, '$twbs_version:              "'  . $twbs_version .  "\";\n");
if ($gplusProfile > ' '  ) 	fwrite($tv_file, '$gplusProfile:              "'  . $gplusProfile .  "\";\n");
if ($wsaDesktopExpand > ' '  ) fwrite($tv_file, '$wsaDesktopExpand: '  . $wsaDesktopExpand .  ";\n");
if ($fgColor > ' '  ) fwrite($tv_file, '$fgColor:          '  . $fgColor .  ";\n");
if ($brandImage > ' ' ) fwrite($tv_file, '$brandImage:        ' . $brandImage .  ";\n");
if ($brandSize > ' '  ) fwrite($tv_file, '$brandSize:         ' . $brandSize . ";\n");
if ($brandWidth > ' ' ) fwrite($tv_file, '$brandWidth:        ' . $brandWidth . ";\n");
if ($bg0Color > ' ' ) fwrite($tv_file, '$bg0Color:          ' . $bg0Color . ";\n");
if ($bg1Image > ' ' ) fwrite($tv_file, '$bg1Image:          ' . $bg1Image .  ";\n");
if ($bg1Image_lg > ' ' ) fwrite($tv_file, '$bg1Image_lg:       ' . $bg1Image_lg .  ";\n");
if ($bg1Image_sm > ' ' ) fwrite($tv_file, '$bg1Image_sm:       ' . $bg1Image_sm .  ";\n");
if ($bg1Width > ' ' ) fwrite($tv_file, '$bg1Width:          ' . $bg1Width . ";\n");
if ($bg1Pos > ' '   ) fwrite($tv_file, '$bg1Pos:            ' . $bg1Pos . ";\n");
if ($bg1Top > ' '  )  fwrite($tv_file, '$bg1Top:            ' . $bg1Top . ";\n");
if ($bg1Left > ' '  ) fwrite($tv_file, '$bg1Left:           ' . $bg1Left . ";\n");
if ($bg1Color > ' ' ) fwrite($tv_file, '$bg1Color:          ' . $bg1Color . ";\n");
if ($bg1Breakpoint_lg > ' '  ) fwrite($tv_file, '$bg1Breakpoint_lg:          '  . $bg1Breakpoint_lg .  "px;\n");
if ($bg1Breakpoint_sm > ' '  ) fwrite($tv_file, '$bg1Breakpoint_sm:          '  . $bg1Breakpoint_sm .  "px;\n");

if ($hlMarginTop > ' '  ) 	fwrite($tv_file, '$hlMarginTop:       '  . $hlMarginTop .  "%;\n");
if ($hlMarginLeft > ' '  ) 	fwrite($tv_file, '$hlMarginLeft:      '  . $hlMarginLeft .  "%;\n");
if ($hlWidth > ' '  ) 		fwrite($tv_file, '$asHeadLeftWidth:   '  . $hlWidth .  "%;\n");				
if ($hlHeight > ' '  ) 		fwrite($tv_file, '$hlHeight:          '  . $hlHeight .  "%;\n");
if ($hlMarginBottom > ' '  ) 	fwrite($tv_file, '$hlMarginBottom:    '  . $hlMarginBottom .  "%;\n");
if ($iconsWidth > ' '  ) 	fwrite($tv_file, '$iconsWidth:        '  . $iconsWidth .  "px;\n");
if ($iconsPosLeft > ' '  ) 	{fwrite($tv_file, '$iconsPosLeft:      '  . $iconsPosLeft .  "%;\n");}
	else {fwrite($tv_file, '$iconsPosLeft:      auto' . ";\n");}
if ($wsaIconsFlex > ' '  ) 	{fwrite($tv_file, '$wsaIconsFlex:      '  . $wsaIconsFlex .  ";\n");}
	else {fwrite($tv_file, '$wsaIconsFlex:      row' . ";\n");}	
if ($iconsPosTop > ' '  ) 	fwrite($tv_file, '$iconsPosTop:       '  . $iconsPosTop .  "px;\n");
if ($iconsMobileLeft > ' '  ) 	fwrite($tv_file, '$iconsMobileLeft:   '  . $iconsMobileLeft .  "%;\n");
if ($iconsMobileWidth > ' '  ) 	fwrite($tv_file, '$iconsMobileWidth:  '  . $iconsMobileWidth .  "%;\n");
if ($wsaNavbarRightWidth > ' '  ) 	fwrite($tv_file, '$wsaNavbarRightWidth:        '  . $wsaNavbarRightWidth .  "px;\n");



fwrite($tv_file, '$menuType:            ' . $menuType . ";\n");
fwrite($tv_file, '$navbar-theme:        ' . $navbartheme . ";\n");
fwrite($tv_file, '$navbar-bg:           ' . $navbarbg . ";\n");

if ($menuColor > ' '  ) { 	fwrite($tv_file, '$menuColor:           '  . $menuColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarlighter:    lighten($menuColor,30%)' .  ";\n");
			  	fwrite($tv_file, '$graynavbardarker:     $menuColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-color: $menuColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-color: $menuColor' .  ";\n");
				
			  	fwrite($tv_file, '$navbar-default-border: rgba($menuColor, .5)' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-border-color: $navbar-default-border' .  ";\n");

//				fwrite($tv_file, '$nav-link-hover-bg: $navbar-default-border' .  ";\n");  // nog even niet onbekend welke kleur te gebruiken

};
if ($menuActiveColor > ' '  ) { fwrite($tv_file, '$menuActiveColor:     '  . $menuActiveColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarfg:         $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-active-color: $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-active-link-hover-border-color: $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-icon-bar-bg: $menuActiveColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-hover-color: $menuActiveColor' .  ";\n");
				                  
};
if ($menuDisabledColor > ' '  ) { fwrite($tv_file, '$menuDisabledColor: '  . $menuDisabledColor .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-disabled-color: $menuDisabledColor' .  ";\n");
};
if ($menuBgColor > ' '  ) { 	fwrite($tv_file, '$menuBgColor:         '  . $menuBgColor .  ";\n");
			  	fwrite($tv_file, '$navbar-default-bg:    $menuBgColor' .  ";\n");
			  	fwrite($tv_file, '$dropdown-bg:    $menuBgColor' .  ";\n");
			  	fwrite($tv_file, '$dropdown-border: rgba($navbar-default-bg, .5)' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-border-color: rgba($navbar-default-bg, .5)' .  ";\n");
};
if ($menuActiveBgColor > ' '  ) { fwrite($tv_file, '$menuActiveBgColor: '  . $menuActiveBgColor .  ";\n");
			  	fwrite($tv_file, '$graynavbarbg:         $menuActiveBgColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-active-bg: $menuActiveBgColor' .  ";\n");
			  	fwrite($tv_file, '$nav-tabs-link-hover-border-color: rgba($navbar-default-link-active-bg, .5)' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-toggle-hover-bg: $menuActiveBgColor' .  ";\n");
			  	fwrite($tv_file, '$navbar-default-link-hover-bg: $menuActiveBgColor' .  ";\n");
				
};

/* overgenomen uit asha-s werkt mogelijk (nog) niet */
if (! empty($showTitle)) 	fwrite($tv_file, '$showTitle:         '  . $showTitle .  ";\n");
if (! empty($tagItemTitleDisplay)) fwrite($tv_file, '$tagItemTitleDisplay: '  . $tagItemTitleDisplay .  ";\n");
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
//
// ============================================================================
//
$st_file =fopen($assetPath .'/scss/style' . $templatestyleid . '.scss', "w+");
/* .scss file dat variabelen gebruikt */
fwrite($st_file, "// style" . $templatestyleid .  ".scss \n");
fwrite($st_file, "// template style " . $input->get('title') .  ".scss \n");
fwrite($st_file, "// generated      " . date("c")  . "\n//\n");
fwrite($st_file, "// css            " . $wsaCssFilename  . "\n//\n");

if (!empty($prr)) fwrite($st_file, "\n/* /\n// debug prr" . $prr  . "\n */\n");

// standaard bootstrap variables mixins etc.
 fwrite($st_file, "//\n// standard bootstrap includes v" . $twbs_version . "\n//\n");

// Custom.scss
// Option B: Include parts of Bootstrap
// Required
fwrite($st_file, '@import "bs' .  $twbs_version . '/functions.scss";' . "\n");
fwrite($st_file, '@import "bs' .  $twbs_version . '/variables.scss";' . "\n");
fwrite($st_file, '@import "bs' .  $twbs_version . '/mixins.scss";' . "\n");

// Optional
fwrite($st_file, "//\n// optional bootstrap includes and override v" . $twbs_version . "\n//\n");
//fwrite($st_file, '@import "wsabs4extra.variables.scss";' . "\n");

// standaard bootstrap variables mixins etc. einde
fwrite($st_file, "//\n// other variables\n//\n");
fwrite($st_file, '@import "magnificpopup.variables.scss";' . "\n");
fwrite($st_file, '@import "template_variables.scss";' . "\n");
fwrite($st_file, '@import "_template_mixins_functions";' . "\n");
fwrite($st_file, "//\n// css\n//\n");


if (! empty($background))
{ 	$pos1 = stripos($background, ".css");
	if ($pos1 > 0)
	{
    $background = substr_replace($background, '.scss', $pos1, 4) ;
	}
	fwrite($st_file, '@import "'  . $background .  "\";\n");
}
fwrite($st_file, '@import "style' . $templatestyleid . '.var.scss";' . "\n");
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

if (strpos($menuType,'transparent') !== false) // != is onvoldoende omdat pos vanaf 0 telt.
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
// ============================================================================
/* einde opslaam style parameters in style.scss bestanden */
/* scss files compileren naar .css */

$server->compileFile($assetPath .'/scss/style' . $templatestyleid . '.scss', $assetPath.'/css/' . $wsaCssFilename);

if ($home == 1 ) 
 {/* niet kunnen vinden van templatestyleid bij root (lijkt inmiddels opgelost te zijn)*/ 
     $server->compileFile($assetPath .'/scss/style' . $templatestyleid . '.scss', $assetPath.'/css/template.min.'  . '.css');
  /* ivm &tmpl=component */
     $server->compileFile($assetPath .'/scss/style' . $templatestyleid . '.scss', $assetPath.'/css/template'  . '.css');
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
