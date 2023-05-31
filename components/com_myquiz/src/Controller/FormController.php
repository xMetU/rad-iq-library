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

class FormController extends BaseController {

    public function saveQuiz() {
        $model = $this->getModel('QuizForm');
        
        $data = Factory::getApplication()->input->post->getArray();

        $model->saveQuiz($data);

        $this->setRedirect(Route::_(
            Uri::getInstance()->current() . '?task=Display.createQuiz&id=' . Factory::getDbo()->insertId(),
            false,
        ));
    }

    public function updateQuiz() {
        $model = $this->getModel('QuizForm');
        
        $data = Factory::getApplication()->input->post->getArray();

        $model->updateQuiz($data);

        $this->setRedirect(Route::_(
			Uri::getInstance()->current() . '?task=Display.createQuiz&id=' . $data['id'],
			false,
		));
    }

    public function deleteQuiz() {
        $model = $this->getModel('AllQuiz');
        
        $quizId = Factory::getApplication()->input->getInt('quizId');

        $model->deleteQuiz($quizId);

        $this->setRedirect(Uri::getInstance()->current() . Route::_('?&task=Display.display', false));
    }


    public function saveQuestion() {
        $model = $this->getModel('QuestionForm');

        $data = Factory::getApplication()->input->post->getArray();

        $model->saveQuestion($data);

        $this->setRedirect(Route::_(
            Uri::getInstance()->current()
            . '?task=Display.questionForm&quizId=' . $data['quizId']
            . '&questionId=' . Factory::getDbo()->insertId(),
            false,
        ));
    }

    public function updateQuestion() {
        $model = $this->getModel('QuestionForm');

        $data = Factory::getApplication()->input->post->getArray();

        $model->updateQuestion($data);

        $this->setRedirect(Route::_(
            Uri::getInstance()->current()
            . '?task=Display.questionForm&quizId=' . $data['quizId']
            . '&questionNumber=' . $data['questionNumber'],
            false,
        ));
    }

    public function deleteQuestion() {
        $model = $this->getModel('QuestionForm');

        $data = Factory::getApplication()->input->post->getArray();

        $model->deleteQuestion($data['questionId']);

        $this->setRedirect(Route::_(
            Uri::getInstance()->current()
            . '?task=Display.questionManager&id=' . $data['quizId'],
            false,
        ));
    }
    
}