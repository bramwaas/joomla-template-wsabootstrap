<?php
/**
 * @package     	Joomla.Site
 * @subpackage  	mod_menu override
 * @copyright   	Copyright (C) 2005 - 2021 Open Source Matters, Inc. All rights reserved.
 * @license     	GNU General Public License version 2 or later; see LICENSE.txt
 * Modifications	Joomla CSS
 * 24-4-2016 ook begin en eind van navbar naar deze module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
 * 30-4-2017 kleine aanpassingen vooruitlopend op BS4
 * 7-1-2018 start with J4 namespaces
 * 5-1-2019 brandimage geen extra / meer
 * 20-1-2019 navtext toegevoegd
 * 26-1-2019  aanpassingen verschillen BS4 en BS3 mbv twbs_version
 * 6-2-2019
 * 26-5-2020 diverse Id's beter uniek gemaakt met <?php echo $moduleIdPos; ?> en moduletag gebruikt
 * 23-10-2021 aanpassingen tbv J4 overgenomen van wsa_onepage template.
 * 25-12-2021 adjustments for Joomla 4 and first for BS5 
 * 30-12-2021 overbodige container-fluid bij eerder verwijderde navbar-inner verwijderd vanwege onnodige padding. 
 * 31-1-2022 referentie naar 'default_'.$item->type verbeterd, zodat deze ook bij gebruik in ander template werkt 
 *  entries voor seperator en heading gekopieerd van mod_menu
 * 17-10-22 2.2.0 wsaDesktopExpand replaces breakpoint of wsaNavbarExpand
 */

\defined('_JEXEC') or die;
use Joomla\CMS\Factory;   // this is the same as use Joomla\CMS\Factory as Factory
use Joomla\CMS\Helper\ModuleHelper;

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
$twbs_version = htmlspecialchars($app->getTemplate(true)->params->get('twbs_version', '4')); // bootstrap version 3, 5 or (default) 4 
if ($twbs_version == 3) {
	$menuType = str_replace(array("light", "dark", "bg-"), array("default", "inverse", ""), $menuType);	
}
$wsaDesktopExpand = htmlspecialchars($app->getTemplate(true)->params->get('wsaDesktopExpand', 'xl'));
$wsaNavtext = ($app->getTemplate(true)->params->get('wsaNavtext'));

$moduleTag     = $params->get('module_tag', 'div');
$moduleIdPos          = 'M' . $module->id . $module->position;


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
		    	<<?php echo $moduleTag; ?> class="navbar navbar-expand-<?php  echo $wsaDesktopExpand .  ' ' . $menuType; ?> " role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<!-- navbar-header -->
					<?php if ($brandImage > " ") : ?>
	         	   	<a class="navbar-brand brand" href="#">
					  <img id="img_brandImage<?php echo $moduleIdPos; ?>" src="<?php echo $brandImage; ?>" alt="Brand image <?php echo $sitename ?>" />
					</a>
					<?php endif; ?>
					<?php if(  $document->countModules('navbar-brand'))    : ?>
					<span id="navbar-brand-mod<?php echo $moduleIdPos; ?>" class="navbar-text navbar-brand" >
					<?php wsa_load('navbar-brand'); ?>
					</span> <!-- end navbar-brand -->
					<?php endif; ?>
					<?php if ($displaySitename == "1") : ?>
					<a class="navbar-brand brand" href="#"><?php echo $sitename ?></a>
					<?php endif; ?>
					<?php echo '<!-- $twbs_version=' . $twbs_version . ". -->\n"; ?>
				    <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse"  data-target="#navbar-<?php echo $moduleIdPos; ?>" data-bs-target="#navbar-<?php echo $moduleIdPos; ?>" aria-controls="#navbar-<?php echo $moduleIdPos; ?>" aria-expanded="false" aria-label="Toggle navigation">
					  <span class="navbar-toggler-icon"></span>
				    </button>
					<!-- navbar-header -->
				   <div id="navbar-<?php echo $moduleIdPos; ?>" class="collapse navbar-collapse">
<!-- oude module -->

<ul <?php echo $id; ?> class="mod-menu nav navbar-nav mr-auto menu<?php echo $class_sfx;?>">
<?php foreach ($list as $i => &$item) 
{
	$class = 'nav-item item-'.$item->id;
	
	if ($item->id == $default_id)
	{
	    $class .= ' default';
	}
	if ($item->id == $active_id  || ($item->type === 'alias' && $item->getParams()->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->getParams()->get('aliasoptions');

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
	
	echo '<!--Itemtype =' . $item->type . ' -->' ;

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
	    echo '<ul id=data-item-' . $moduleIdPos . $item->id . ' class="nav-child unstyled mod-menu__sub list-unstyled small dropdown-menu" . aria-labelledby="dropdownMenuLink-' . $moduleIdPos . $item->id . '">';
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
}
?></ul>
<!-- einde oude module -->
<?php if ($wsaNavtext > " ") : ?>
						<?php echo $wsaNavtext;  ?>
<?php endif; ?>
				<?php if(  $document->countModules('navbar-right'))    : ?>
					<span id="navbar-right-mod<?php echo $moduleIdPos; ?>" class="navbar-text navbar-right" >
					<?php wsa_load('navbar-right'); ?>
					</span> <!-- end navbar-right -->
				<?php endif; ?>
	          	   </div>
		    	</<?php echo $moduleTag; ?>>
<!--End navbar-->