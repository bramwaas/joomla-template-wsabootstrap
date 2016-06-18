<?php
/**
 * @package     	Joomla.Site
 * @subpackage  	mod_menu override
 * @copyright   	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     	GNU General Public License version 2 or later; see LICENSE.txt
 * Modifications	Joomla CSS
 * 24-4-2016 ook begin en eind van navbar naar deze module-override gehaald (uit module position-1), zodat deze overal in index.php geplaatst kan worden
 */

defined('_JEXEC') or die;
// Note. It is important to remove spaces between elements.
$app = JFactory::getApplication();
$sitename = $app->getCfg('sitename');
$displaySitename = htmlspecialchars($app->getTemplate(true)->params->get('displaySitename')); // 1 yes 2 no
$brandImage = htmlspecialchars($app->getTemplate(true)->params->get('brandImage')); 
if ($brandImage > ' ' and strtolower(substr ( $brandImage , 0 , 7 )) == 'images/' ) 
 {$brandImage = '/' . $brandImage;}; 

?>

<!-- Begin Navbar-->
<?php // div in plaats van nav gebruikt oa IE8 nav nog niet kent ?>
		    	<div class="navbar navbar-default " role="navigation">
		         <div class="navbar-inner">
		          <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button"  class="navbar-toggle" data-toggle="collapse" data-target="#navbar-pos1" aria-controls="navbar-pos1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
 						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button> 
					<?php if ($brandImage > " ") : ?>
	         	   	<a class="navbar-brand brand" href="#">
					<img id="img_brandImage" src="<?php echo $brandImage; ?>" alt="Brand image <?php echo $sitename ?>" />
				</a>
					<?php endif; ?>
			   <?php if ($displaySitename == "1") : ?>
	         	   <a class="navbar-brand brand" href="#"><?php echo $sitename ?></a>
			   <?php endif; ?>
					</div> <!-- navbar-header -->
				   <div id="navbar-pos1" class="collapse navbar-collapse">

<!-- oude module -->

<ul class="nav navbar-nav menu <?php echo $class_sfx;?>"<?php
	$tag = '';
	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id)
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type == 'alias')
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

	if ($item->type == 'separator')
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

	if (!empty($class))
	{
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper){
		echo '<ul class="nav-child unstyled small dropdown-menu">';
	}
	elseif ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
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
	          	   </div>
		          </div>
		      	 </div> <!-- end navbar-inner -->
		    	</div>
<!--End navbar-->




