<?php

namespace Kieran\Component\MyQuiz\Administrator\Controller;

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

        $view = $this->getView('AdminQuizView', $viewFormat);
        $model = $this->getModel('AdminAllQuiz');
        
        $view->setModel($model, true);   

        $view->document = $document;
        $view->display();

    }

    public function hideQuiz() {
        
        $model = $this->getModel('AdminAllQuiz');

        $hideQuiz = $_POST;

        if($hideQuiz) {
            foreach($hideQuiz as $quizId) {

                $num = $model->checkHidden($quizId);
                
                if($num){
                    if($num == 0) {
                        $model->setQuizHiddenStatus($quizId, 1);
                    }
                    else {
                        $model->setQuizHiddenStatus($quizId, 0);
                    }
                }
                else{
                    $model->setQuizHiddenStatus($quizId, 1);
                }
                
                
            }
        }

        $this->setRedirect(Uri::getInstance()->current() . Route::_('?option=com_myquiz&task=Display.display', false));
    }
    
}