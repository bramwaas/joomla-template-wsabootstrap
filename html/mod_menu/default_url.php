<?php
/**
 * @package     	Joomla.Site
 * @subpackage  	mod_menu override
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * Modifications	Joomla CSS
 * bw 2015-09-26       line 56 </a></span> changed in </span></a></span>
 * 23-10-2021 aanpassingen tbv J4 overgenomen van wsa_onepage template.
 * 25-12-2021 eerste aanpassingen BS5 (data- => data-bs- )
 * 28-12-2021  ook hier nav-link toegevoegd bij class voor <a> ivm BS5
 * 21-11-2025 compared with joomla 6.1 original and made some smaal changes
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Filter\OutputFilter;

$attributes = [];

if (!empty($item->anchor_title)) {
    $attributes['title'] = $item->anchor_title;
}

if (!empty($item->anchor_css)) {
    $attributes['class'] = $item->anchor_css;
}

if (!empty($item->anchor_rel)) {
    $attributes['rel'] = $item->anchor_rel;
}

$linktype = $item->title;

if ($item->menu_icon) {
    // The link is an icon
    if ($itemParams->get('menu_text', 1)) {
        // If the link text is to be displayed, the icon is added with aria-hidden
        $linktype = '<span class="p-2 pt-0 ' . $item->menu_icon . '" aria-hidden="true"></span>' . $item->title;
    } else {
        // If the icon itself is the link, it needs a visually hidden text
        $linktype = '<span class="p-2 pt-0 ' . $item->menu_icon . '" aria-hidden="true"></span><span class="visually-hidden">' . $item->title . '</span>';
    }
} elseif ($item->menu_image)
{
	    // The link is an image, maybe with an own class
    $image_attributes = [];

    if ($item->menu_image_css) {
        $image_attributes['class'] = $item->menu_image_css;
    }

    $linktype = HTMLHelper::_('image', $item->menu_image, '', $image_attributes);

    $linktype .= '<span class="image-title' . ($itemParams->get('menu_text', 1) ? '' : ' visually-hidden') . '">' . $item->title . '</span>';
    if ($item->deeper) {
        $attributes['class'] = 'class="'.$item->anchor_css.' dropdown-toggle" data-toggle="dropdown"  data-bs-toggle="dropdown" ';
        $item->flink = '#';
    }
    
}
elseif ($item->deeper) {
    $linktype = $item->title. '<b class="caret"></b>' ;
    if ($item->level < 2) {
        $attributes['class'] = 'class="'.$item->anchor_css.' dropdown-toggle" data-toggle="dropdown"  data-bs-toggle="dropdown" ';
        $item->flink = '#';
    }
    else {
        $linktype = $item->title;
    }
}
else {
    $linktype = $item->title;
}

$attributes['class'] = ($attributes['class'] > ' ') ? str_ireplace('class="','class="nav-link ',$attributes['class']) : 'class="nav-link" ';

$flink = $item->flink;
$flink = OutputFilter::ampReplace(htmlspecialchars($flink));

switch ($item->browserNav) :
default:
case 0:
    ?><a <?php echo $attributes['class']; ?>href="<?php echo $flink; ?>" <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $attributes['class']; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a><?php
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $attributes['class']; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $attributes['title']; ?>><span><?php echo $linktype; ?></span></a><?php
		break;
endswitch;

//echo HTMLHelper::_('link', OutputFilter::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);

