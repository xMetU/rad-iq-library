<?php

namespace Kieran\Component\MyQuiz\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;


/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array()) {     
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('QuizzesView', $viewFormat);

        $model = $this->getModel('Quizzes');
        $model2 = $this->getModel('Categories');
        $view->setModel($model, true);
        $view->setModel($model2);

        $view->document = $document;
        $view->display();
    }

    public function quiz() {
        $userId = Factory::getUser()->id;
        if ($userId) {
            $document = Factory::getDocument();
            $viewFormat = $document->getType();
            
            $model1 = $this->getModel('Quiz');
            $model2 = $this->getModel('Questions');
            $model3 = $this->getModel('Answers');
            $view = $this->getView('QuizView', $viewFormat);       
            $view->setModel($model1);
            $view->setModel($model2);
            $view->setModel($model3);
    
            $view->document = $document;
            $view->display();
        }
        else {
            Factory::getApplication()->enqueueMessage('Please login to continue');
            $this->setRedirect(Route::_('?index.php', false));
        }
    }

    public function quizForm() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('QuizFormView', $viewFormat);

        $model1 = $this->getModel('Images');
        $model2 = $this->getModel('Quiz');
        $view->setModel($model1, true); 
        $view->setModel($model2); 

        $view->document = $document;
        $view->display();
    }

    public function questionForm() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('QuestionFormView', $viewFormat);

        $model1 = $this->getModel('Questions');
        $model2 = $this->getModel('Question');
        $model3 = $this->getModel('Quiz');
        $view->setModel($model1, true);
        $view->setModel($model2);
        $view->setModel($model3);

        $view->document = $document;
        $view->display();
    }

    public function answerForm() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('AnswerFormView', $viewFormat);

        $model1 = $this->getModel('Answers');
        $model2 = $this->getModel('Answer');
        $model3 = $this->getModel('Question');
        $view->setModel($model1, true);
        $view->setModel($model2);
        $view->setModel($model3);

        $view->document = $document;
        $view->display();
    }

    public function summary() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('SummaryView', $viewFormat);

        $model1 = $this->getModel('UserAnswer');
        $model2 = $this->getModel('Questions');
        $view->setModel($model1, true);
        $view->setModel($model2);  

        $view->document = $document;
        $view->display();
    }

    public function scores() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();
        $view = $this->getView('ScoresView', $viewFormat);

        $model = $this->getModel('Scores');
        $view->setModel($model, true);

        $view->document = $document;
        $view->display();
    }

    public function toggleIsHidden() {
        $model = $this->getModel('Quizzes');
		$quizId = Factory::getApplication()->input->getVar('id');
		$model->toggleIsHidden($quizId);
		$this->setRedirect(Route::_(
			Uri::getInstance()->current(),
			false,
		));
    }

}