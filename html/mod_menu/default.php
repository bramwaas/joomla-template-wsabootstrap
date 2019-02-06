<?php
/**
 * @package     	Joomla.Site
 * @subpackage  	mod_menu override
 * @copyright   	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     	GNU General Public License version 2 or later; see LICENSE.txt
 * Modifications	Joomla CSS
 * 24-4-2016 ook begin en eind van navbar naar deze module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
 * 30-4-2017 kleine aanpassingen vooruitlopend op BS4
 * 7-1-2018 start with J4 namespaces
 * 5-1-2019 brandimage geen extra / meer
 * 20-1-2019 navtext toegevoegd
 * 26-1-2019  aanpassingen verschillen BS4 en BS3 mbv twbs_version
 * 6-2-2019
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;   // this is the same as use Joomla\CMS\Factory as Factory
use Joomla\CMS\Helper\ModuleHelper;

//use Joomla\CMS\HTML\HTMLHelper;
//use Joomla\CMS\Plugin\PluginHelper;
//use Joomla\CMS\Document\HtmlDocument;
//use Joomla\CMS\Document\Renderer\Html\ModulesRenderer;





$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// Note. It is important to remove spaces between elements.
$app = Factory::getApplication();
$document = Factory::getDocument();
$sitename = $app->get('sitename');
$displaySitename = htmlspecialchars($app->getTemplate(true)->params->get('displaySitename')); // 1 yes 2 no
$brandImage = htmlspecialchars($app->getTemplate(true)->params->get('brandImage'));
$menuType = htmlspecialchars($app->getTemplate(true)->params->get('menuType'));
$twbs_version = htmlspecialchars($app->getTemplate(true)->params->get('twbs_version', '4')); // bootstrap version 3 of (default) 4 
if ($twbs_version == 3) {
	$menuType = str_replace(array("light", "dark", array("default", "inverse")), $menuType);	
}
/*
$wsaBreakpointes =  htmlspecialchars($app->getTemplate(true)->params->get('wsaBreakpointes'));
$wsaContainerxs = $wsaBreakpointxs;
$wsaBreakpointxxl = htmlspecialchars($app->getTemplate(true)->params->get('wsaBreakpointxx)'));
$wsaContainerxxl = htmlspecialchars($app->getTemplate(true)->params->get('wsaContainerxxl'));
if (! $wsaContainerxxl) {$wsaContainerxxl = $wsaBreakpointxxl; }
$wsaBreakpointxxxl = htmlspecialchars($app->getTemplate(true)->params->get('wsaBreakpointxxxl'));
$wsaContainerxxxl = htmlspecialchars($app->getTemplate(true)->params->get('wsaContainerxxxl'));
if (! $wsaContainerxxxl) {$wsaContainerxxxl = $wsaBreakpointxxxl; }
*/
$wsaNavbarExpand = htmlspecialchars($app->getTemplate(true)->params->get('wsaNavbarExpand', 'navbar-expand-md'));
$navbar = 'navbar-light';
if ($menuType > ' ')  $navbar = 'navbar-' . $menuType;
$wsaNavtext = ($app->getTemplate(true)->params->get('wsaNavtext'));

	/**
	 * Loads and renders the module
	 *
	 * @param   string  $position  The position assigned to the module
	 * @param   string  $style     The style assigned to the module
	 *
	 * @return  mixed
	 *
	 * copied from plugins\content\loadmodule 
	 */
	 function wsa_load($position, $style = 'none')
	{
		
		//self::$modules[$position] = '';
		$document = Factory::getDocument();
		$renderer = $document->loadRenderer('module');
		$modules  = ModuleHelper::getModules($position);
		$params   = array('style' => $style);
		//ob_start();

		foreach ($modules as $module)
		{
			echo $renderer->render($module, $params);
		}

		// self::$modules[$position] = ob_get_clean();

		return $modules[$position];
		
	}
?>


<!-- Begin Navbar-->
<?php // div in plaats van nav gebruikt oa IE8 nav nog niet kent ?>
		    	<div class="navbar <?php echo  $wsaNavbarExpand .  ' ' . $navbar; ?> " role="navigation">
		         <!-- div class="navbar-inner" -->
		          <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<!-- navbar-header -->
					<?php if ($displaySitename == "1") : ?>
					<a class="navbar-brand brand" href="#"><?php echo $sitename ?></a>
					<?php endif; ?>
					<?php echo '<!-- $twbs_version=' . $twbs_version . ". -->\n"; ?>
					<?php if ($twbs_version == '3') : ?>
					<div class="navbar-header">
					  <button type="button"  class="navbar-toggle" data-toggle="collapse" data-target="#navbar-pos1" aria-controls="navbar-pos1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
 						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button> 
					<?php else: // $twbs_version == '4' ?>
				    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-pos1" aria-controls="#navbar-pos1" aria-expanded="false" aria-label="Toggle navigation">
					  <span class="navbar-toggler-icon"></span>
				    </button>
					<!-- navbar-header -->
					<?php endif; ?>
					<?php if ($brandImage > " ") : ?>
	         	   	<a class="navbar-brand brand" href="#">
					  <img id="img_brandImage" src="<?php echo $brandImage; ?>" alt="Brand image <?php echo $sitename ?>" />
					</a>
					<?php endif; ?>
					<?php if ($twbs_version == '3') : ?>
					</div> <!-- navbar-header -->
					<?php endif; ?>
				   <div id="navbar-pos1" class="collapse navbar-collapse">

<!-- oude module -->

<ul <?php echo $id; ?> class="navbar-nav mr-auto nav menu<?php echo $class_sfx;?>">
<?php foreach ($list as $i => &$item) :
	
	$class = 'nav-item item-'.$item->id;
	if ($item->id == $active_id  || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper) {
		if ($item->level < 2) {
			$class .= ' dropdown deeper';
		}
		else {
			$class .= ' dropdown-submenu deeper';
		}
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}

	echo '<li class="' . $class . '">';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
		    require ModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
			break;

		default:
		    require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper){
		echo '<ul class="nav-child unstyled small dropdown-menu">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
<!-- einde oude module -->
<?php if ($wsaNavtext > " ") : ?>
						<?php echo $wsaNavtext;  ?>
<?php endif; ?>
				<?php if(  $document->countModules('navbar-right'))    : ?>
					<span id="navbar-right-mod" class="navbar-text navbar-right" >
					<?php wsa_load('navbar-right'); ?>
					</span> <!-- end navbar-right -->
				<?php endif; ?>
	          	   </div>
		          </div>
		      	 <!-- /div--> <!-- end navbar-inner -->
		    	</div>
<!--End navbar-->