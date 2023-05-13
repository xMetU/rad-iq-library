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

class UploadController extends BaseController {
    


    public function display($cachable = false, $urlparams = array()) {     

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('UploadImageView', $viewFormat);
        $view->setModel($this->getModel('UploadImage'), true);

        $view->document = $document;
        $view->display();
    }

    
}