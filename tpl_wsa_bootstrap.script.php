<?php
/**
 * @version $Id: tpl_wsa_bootstrap.script.php
 * @package wsa_bootstrap
 * @copyright Copyright (C) 2024 - 2024 AHC Waasdorp, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
 * @developer AHC Waasdorp
 * 2.3.0 2024-12-24 move assets from template to media remove unused file(s) and maps update inheritable in styles.
 */
defined('_JEXEC') or die;

use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
//use Joomla\Filesystem\Exception\FilesystemException;
use Joomla\Filesystem\File;
use Joomla\Filesystem\Folder;
use Joomla\Filesystem\Path;

return new class () implements ServiceProviderInterface {
    public function register(Container $container)
    {
        $container->set(
            InstallerScriptInterface::class,
            new class (
                $container->get(AdministratorApplication::class),
                $container->get(DatabaseInterface::class)
                ) implements InstallerScriptInterface {
    private AdministratorApplication $app;
    private DatabaseInterface $db;
    private string $minimumJoomla = '4.1.0';
    private string $minimumPhp    = '7.4.0';
    
    /**
     * Constructor
     *
     * @param   InstallerAdapter  $adapter  The object responsible for running this script
     * @param   DatabaseInterface $db
     */
    public function __construct(AdministratorApplication $app, DatabaseInterface $db)
    {
        $this->app = $app;
        $this->db  = $db;
    }
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
        $TPL_PATH = "/templates/wsa_bootstrap/";
        $TPL_MEDIA = "/media/templates/site/wsa_bootstrap/";
        $first_message = true;
        $paths = ['css', 'images', 'js', 'scss'];
        foreach($paths as $path) {
            if (is_dir(Path::clean(JPATH_ROOT . $TPL_PATH . $path)) && Folder::copy($TPL_PATH . $path, $TPL_MEDIA . $path, JPATH_ROOT, true, true)) {
                if ($first_message) {
                    $this->app->enqueueMessage(Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT') ,'message');
                    $first_message = false;
                }
                $this->app->enqueueMessage( $TPL_PATH . $path . Text::sprintf('TPL_WSA_BOOTSTRAP_MOVED_TEXT') . $TPL_MEDIA, 'message');
            }
         }  
         $paths[] = 'less';
         foreach($paths as $path) {
             
             if (is_dir(Path::clean(JPATH_ROOT . $TPL_PATH . $path)) && Folder::delete(JPATH_ROOT . $TPL_PATH . $path)) {
                 if ($first_message) {
                     $this->app->enqueueMessage(Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT'), 'message');
                     $first_message = false;
                 }
                 $this->app->enqueueMessage($TPL_PATH . $path . Text::sprintf('TPL_WSA_BOOTSTRAP_REMOVED_TEXT'), 'message');
             }
        }
        $paths = ['template_preview.png','template_thumbnail.png'];
        foreach($paths as $path) {
            if (is_file(Path::clean(JPATH_ROOT . $TPL_PATH . $path)) && File::delete(JPATH_ROOT . $TPL_PATH . $path)) {
                if ($first_message) {
                    $this->app->enqueueMessage(Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT'), 'message');
                    $first_message = false;
                }
                $this->app->enqueueMessage($TPL_PATH . $path . Text::sprintf('TPL_WSA_BOOTSTRAP_REMOVED_TEXT'), 'message');
            } 
        }
        $this->db->setQuery('SELECT count(*) FROM #__template_styles WHERE template = "wsa_bootstrap" AND inheritable != 1');
        $cnt = $this->db->loadResult();
        if (0 < $cnt) {
            $this->db->setQuery('UPDATE #__template_styles SET inheritable = 1 WHERE template = "wsa_bootstrap" AND inheritable != 1');
            if ($first_message) {
                $this->app->enqueueMessage(Text::sprintf('TPL_WSA_BOOTSTRAP_PREFLIGHT_TEXT'),'message');
                $first_message = false;
            }
            if ($this->db->execute()) {
                $this->app->enqueueMessage('' . $cnt . Text::sprintf('TPL_WSA_BOOTSTRAP_UPD_STYLES'), 'message'); 
            } else {
                $this->app->enqueueMessage(Text::sprintf('TPL_WSA_BOOTSTRAP_UPD_FAILED'),'warning');
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
);
}
};
