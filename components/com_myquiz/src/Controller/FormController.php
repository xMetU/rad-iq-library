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
			Uri::getInstance()->current() . '?task=Display.createQuiz&id=' . $data['id'],
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

    // public function deleteQuestion() {
    //     $model = $this->getModel('QuizForm');

    //     $data = Factory::getApplication()->input->post->getArray();
    // }

    // public function saveQuestion() {
    //     $model = $this->getModel('QuestionForm');

    //     $data = Factory::getApplication()->input->post->getArray();
    // }

    // public function updateQuestion() {
    //     $model = $this->getModel('QuestionForm');

    //     $data = Factory::getApplication()->input->post->getArray();
    // }
    
}