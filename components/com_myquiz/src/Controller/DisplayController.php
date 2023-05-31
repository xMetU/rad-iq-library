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

        $view = $this->getView('AllQuizView', $viewFormat);
        $model = $this->getModel('AllQuiz');
        $model2 = $this->getModel('ButtonCategories');
        $model3 = $this->getModel('SaveAnswers');
        
        $view->setModel($model, true);   
        $view->setModel($model2);
        $view->setModel($model3);

        $view->document = $document;
        $view->display();
    }

    public function questionDisplay() {

        $userId = Factory::getUser()->id;

        // Not logged in
        if($userId === 0) {
            Factory::getApplication()->enqueueMessage('Please login to continue');
            $this->setRedirect(Route::_('?index.php', false));
        }

        else{
            $document = Factory::getDocument();
            $viewFormat = $document->getType();
    
            $model1 = $this->getModel('QuizAnswers');
            $model2 = $this->getModel('QuizQuestions');
    
            $view = $this->getView('QuestionAnswerView', $viewFormat);       
            $view->setModel($model1, true);   
            $view->setModel($model2, false);
    
            $view->document = $document;
            $view->display();
        }
    }

    public function summaryDisplay() {

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('SummaryView', $viewFormat);
        $model1 = $this->getModel('Summary');
        $model2 = $this->getModel('SaveAnswers');
        $model3 = $this->getModel('QuizQuestions');

        $view->setModel($model1, true);   
        $view->setModel($model2);  
        $view->setModel($model3); 

        $view->document = $document;
        $view->display();
    }

    public function quizScoresDisplay() {
        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('QuizScoresView', $viewFormat);
        $model = $this->getModel('QuizScores');
        $view->setModel($model, true);

        $view->document = $document;
        $view->display();
    }

    public function createQuiz() {

        $document = Factory::getDocument();
        $viewFormat = $document->getType();

        $view = $this->getView('CreateQuizView', $viewFormat);
        $model1 = $this->getModel('AllImages');
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

    public function toggleIsHidden() {
        $model = $this->getModel('AllQuiz');

		$quizId = Factory::getApplication()->input->getVar('id');

		$model->toggleIsHidden($quizId);

		$this->setRedirect(Route::_(
			Uri::getInstance()->current(),
			false,
		));
    }

    

}