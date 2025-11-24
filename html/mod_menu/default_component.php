<?php

/**
 * @package     	Joomla.Site
 * @subpackage  	mod_menu override
 * @copyright   	Copyright (C) 2005 - 2025 Open Source Matters, Inc. All rights reserved.
 * @license     	GNU General Public License version 2 or later; see LICENSE.txt
 * Modifications	Joomla CSS
 * 30-4-2017 nav-link toegevoegd bij class voor <a> ivm BS4
 * 1-1-2018 foutje in html na-link verbeterd door ontbrekende spatie na " in te voegen.
 * 9-2-2019 data-target toegevoegd voor openen submenu's
 * 2020-05-26 Item->id gekwalificeerd met $moduleIdPos om hem beter uniek te maken
 * 23-10-2021 aanpassingen tbv J4 overgenomen van wsa_onepage template.
 * 25-12-2021 eerste aanpassingen BS5 (data- => data-bs- )
 * 22-11-2025 2.4.0 more adaptations to BS5 (active from li to a tag)
 */

defined('_JEXEC') or die;

$attributes = ['title'=>'','class'=>'', 'active'=>'', 'rel'=>'', 'data'=>''];

if (!empty($item->anchor_title)) {
    $attributes['title'] = $item->anchor_title;
}

if (!empty($item->anchor_css)) {
    $attributes['class'] = $item->anchor_css;
}

if (!empty($item->anchor_rel)) {
    $attributes['rel'] = $item->anchor_rel;
}

if ($twbs_version >= '5') {
    if (in_array($item->id, $path)) {
        $attributes['active'] = 'active ';
    } elseif ($item->type === 'alias') {
        $aliasToId = $itemParams->get('aliasoptions ');
        if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
            $attributes['active'] = 'active ';
        } elseif (in_array($aliasToId, $path)) {
            $attributes['active'] = 'alias-parent-active ';
        }
    }
}

if ($item->menu_image)
{
    $item->getParams()->get('menu_text', 1) ?
    $linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><div class="image-title">'.$item->title.'</div> ' :
    $linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
    
    if ($item->deeper) {
        $attributes['class'] = 'class="'. $attributes['active'] .$item->anchor_css.' dropdown-toggle"';
        $attributes['data'] = ' data-toggle="dropdown"  data-bs-toggle="dropdown" ';
        $item->flink = '#';
    }
}

elseif ($item->deeper) {
    $linktype = $item->title. '<b class="caret"></b>' ;
    if ($item->level < 2) {
        $attributes['class'] = 'class="' . $attributes['active'] .$item->anchor_css.' dropdown-toggle"';
        $attributes['data'] = ' data-toggle="dropdown"  data-bs-toggle="dropdown" ';
        $item->flink = '#data-item-' . $moduleIdPos . $item->id ;
    }
    else { // level >= 2
        $linktype = $item->title;  // origineel alleen deze
    }
}

else {
    $linktype = $item->title;
}

$attributes['class'] = ($attributes['class'] > ' ') ? str_ireplace('class="','class="nav-link ',$attributes['class']) : 'class="nav-link" ';



switch ($item->browserNav) :
default:
case 0:
    ?><a id="dropdownMenuLink-<?php echo $moduleIdPos . $item->id . '" ' . $attributes['class']; ?> href="<?php echo $item->flink; ?>"  <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a><?php
    break;

	case 1:
		// _blank
		?><a <?php echo $attributes['class'] . $attributes['data']; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a><?php
		break;

	case 2:
	// window.open

	    ?><a <?php echo $attributes['class'] . $attributes['data']; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a>
<?php
		break;

endswitch;
