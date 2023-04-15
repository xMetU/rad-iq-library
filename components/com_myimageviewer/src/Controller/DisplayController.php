<?php

namespace Kieran\Component\MyImageViewer\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 *
 */

class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array()) {     
        
        $document = Factory::getDocument();
        // $viewName = $this->input->getCmd('view', 'login');
        $viewFormat = $document->getType();
        
        $view = $this->getView('ImageView', $viewFormat);
        $view->setModel($this->getModel('Image'), true);
        
        $view->document = $document;
        $view->display();
    }
    
}