<?php
/**
 * @version $Id: tpl_wsa_bootstrap.script.php
 * @package wsa_bootstrap
 * @copyright Copyright (C) 2024 - 2024 AHC Waasdorp, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
 * @developer AHC Waasdorp
 * 2024-12-22 move assets from template to media remove unused file(s) and maps.
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;

return new class () implements InstallerScriptInterface 
{
    private string $minimumJoomla = '4.1.0';
    private string $minimumPhp    = '7.4.0';
    const TPL_PATH = "/templates/wsa_bootstrap/";
    const TPL_MEDIA = "/media/templates/site/wsa_bootstrap/";
    
    
    
//     /**
//      * Constructor
//      *
//      * @param   InstallerAdapter  $adapter  The object responsible for running this script
//      */
//     public function __construct(InstallerAdapter $adapter)
//     {
//     }
    
    /**
     * Called before any type of action
     *
     * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function preflight($route, InstallerAdapter $adapter): bool
    {
        $first_message = true;
        $paths = ['css', 'images', 'js', 'scss'];
        foreach($paths as $path) {

            if (Folder::exists(JPATH_ROOT . TPL_PATH . $path) && Folder::copy(TPL_PATH . $path, TPL_MEDIA . $path, JPATH_ROOT, true, true)) {
                if ($first_message) {
                    echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
                    $first_message = false;
                }
                echo '<p>', TPL_PATH . $path, Text::sprintf('TPL_WSA_BOOTSTRAP_MOVED_TEXT') . TPL_MEDIA . '</p>';
            }
         }  
         foreach($paths as $path) {
             
             if (Folder::exists(JPATH_ROOT . TPL_PATH . $path) && Folder::delete(JPATH_ROOT . TPL_PATH . $path)) {
                 if ($first_message) {
                     echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
                     $first_message = false;
                 }
                 echo '<p>', TPL_PATH . $path, Text::sprintf('TPL_WSA_BOOTSTRAP_REMOVED_TEXT') . '</p>';
             }
             
        }
//         $paths = ['/templates/wsa_bootstrap/template_preview.png','/templates/wsa_bootstrap/template_thumbnail.png'];
//         foreach($paths as $path) {
//             if (File::exists(JPATH_ROOT . $path) && File::delete(JPATH_ROOT . $path)) {
//                 if ($first_message) {
//                     echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
//                     $first_message = false;
//                 }
//                 echo '<p>', $path, Text::sprintf('TPL_WSA_BOOTSTRAP_REMOVED_TEXT') . '</p>';
//             } 
            
//         }
        
        if(version_compare($this->getParam('version'), '0.0.1', 'lt')) {
            
            $db = Factory::getDBO();
            $db->setQuery('UPDATE #__template_styles SET inheritable = 1 WHERE template = "wsa_bootstrap" AND inheritable = 0');
            
//            echo '<p>' .  $db->loadResult() . '</p>';
            if ($first_message) {
                echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
                $first_message = false;
            }
            echo '<p>' .  $db->query() . '</p>';
            
            }
        }
        
        
        return true;
    }
    
    /**
     * Called after any type of action
     *
     * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function postflight($route, $adapter): bool
    {
        return true;
    }
    
    /**
     * Called on installation
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function install(InstallerAdapter $adapter): bool
        {
        return true;
    }
    
    /**
     * Called on update
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function update(InstallerAdapter $adapter): bool
    {
        
        //     echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_UPDATE_TEXT') . '</p>';
        
        
        
        return true;
    }
    
    /**
     * Called on uninstallation
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     */
    public function uninstall(InstallerAdapter $adapter): bool
    {
        return true;
    }
}

?>
