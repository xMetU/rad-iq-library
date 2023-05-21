<?php

namespace Kieran\Component\MyImageViewer\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 */


class DisplayController extends BaseController {
    

    public function display($cachable = false, $urlparams = array()) {

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('AdminImageView', $viewFormat);
        $model = $this->getModel('AdminAllImage');
        
        $view->setModel($model, true);   

        $view->document = $document;
        $view->display();

    }

    public function hideImage() {
        
        $model = $this->getModel('AdminAllImage');

        $hideImage = $_POST;

        if($hideImage) {
            foreach($hideImage as $imageId) {

                $num = $model->checkHidden($imageId);
                
                if($num){
                    if($num == 0) {
                        $model->setImageHiddenStatus($imageId, 1);
                    }
                    else {
                        $model->setImageHiddenStatus($imageId, 0);
                    }
                }
                else{
                    $model->setImageHiddenStatus($imageId, 1);
                }
                
                
            }
        }

        $this->setRedirect(Uri::getInstance()->current() . Route::_('?option=com_myimageviewer&task=Display.display', false));
    }
    
}