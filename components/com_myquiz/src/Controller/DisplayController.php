<?php

namespace Kieran\Component\MyQuiz\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 *
 */

class DisplayController extends BaseController {
    


    public function display($cachable = false, $urlparams = array()) {     

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('AllQuizView', $viewFormat);
        $model = $this->getModel('AllQuiz');
        
        $view->setModel($model, true);   

        $view->document = $document;
        $view->display();
    }


    public function quizDisplay() {

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('QuizDisplayView', $viewFormat);

        $model1 = $this->getModel('QuizInfo');
        $model2 = $this->getModel('QuizQuestions');
        
        $view->setModel($model1, true); 
        $view->setModel($model2, false);   

        $view->document = $document;
        $view->display();
    }


    public function questionDisplay() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('QuestionAnswerView', $viewFormat);

        $model = $this->getModel('QuestionAnswers');
        
        $view->setModel($model, true);   

        $view->document = $document;
        $view->display();
    }

}