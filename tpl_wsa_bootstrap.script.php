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
    /**
     * Constructor
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     */
    public function __construct(InstallerAdapter $adapter)
    {
    }
    
    /**
     * Called before any type of action
     *
     * @param   string  $route  Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     *
     * @return  boolean  True on success
     */
    public function preflight($route, InstallerAdapter $adapter)
    {
        $first_message = true;
        $paths = ['css', 'images', 'js', 'scss'];
        foreach($paths as $path) {

            if (Folder::exists(JPATH_ROOT . '/templates/wsa_bootstrap/' . $path) && Folder::copy('/templates/wsa_bootstrap/' . $path, '/media/templates/site/wsa_bootstrap' . $path, JPATH_ROOT, true, true)) {
                if ($first_message) {
                    echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
                    $first_message = false;
                }
                echo '<p>', $path, Text::sprintf('TPL_WSA_BOOTSTRAP_MOVED_TEXT') . '</p>';
            }
         }  
         foreach($paths as $path) {
             
             if (Folder::exists(JPATH_ROOT . '/templates/wsa_bootstrap/' . $path) && Folder::delete(JPATH_ROOT . '/templates/wsa_bootstrap/' . $path)) {
                 if ($first_message) {
                     echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') . '</p>';
                     $first_message = false;
                 }
                 echo '<p>', $path, Text::sprintf('TPL_WSA_BOOTSTRAP_REMOVED_TEXT') . '</p>';
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
    public function postflight($route, $adapter)
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
    public function install(InstallerAdapter $adapter)
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
    public function update(InstallerAdapter $adapter)
    {
        
        //     echo '<p>' . Text::sprintf('TPL_WSA_BOOTSTRAP_UPDATE_TEXT') . '</p>';
        
        
        
        return true;
    }
    
    /**
     * Called on uninstallation
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     */
    public function uninstall(InstallerAdapter $adapter)
    {
        return true;
    }
}

?>
