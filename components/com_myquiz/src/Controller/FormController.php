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

        // Perform post filtering
        $title = Factory::getApplication()->input->post->getVar('title');
        $imageId = Factory::getApplication()->input->post->getInt('imageId');
        $attemptsAllowed = Factory::getApplication()->input->post->getInt('attemptsAllowed');
        $description = Factory::getApplication()->input->post->getVar('description');

        $data = ['title' => $title, 'imageId' => $imageId,
            'attemptsAllowed' => $attemptsAllowed, 'description' => $description];
        Factory::getApplication()->setUserState('myQuiz.quizForm', $data);

        // Perform server side validation
        if ($this->validateQuiz($title, $imageId, $attemptsAllowed, $description)) {
            $data = array($title, $imageId, $attemptsAllowed, $description);
            if ($model->saveQuiz($data)) {
                $this->navigateToQuestionForm(Factory::getDbo()->insertId());
            } else {
                $this->navigateToQuizForm();
            }         
        }
        else {
            $this->navigateToQuizForm();
        }
    }

    public function updateQuiz() {
        $model = $this->getModel('QuizForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->getInt('quizId');
        $title = Factory::getApplication()->input->post->getVar('title');
        $imageId = Factory::getApplication()->input->post->getInt('imageId');
        $attemptsAllowed = Factory::getApplication()->input->post->getInt('attemptsAllowed');
        $description = Factory::getApplication()->input->post->getVar('description');

        $data = ['quizId' => $quizId, 'title' => $title, 'imageId' => $imageId, 
            'attemptsAllowed' => $attemptsAllowed, 'description' => $description];
        Factory::getApplication()->setUserState('myQuiz.quizForm', $data);

        // Perform server side validation
        if ($this->validateQuiz($title, $imageId, $attemptsAllowed, $description)) {
            $model->updateQuiz($data);
        }
        $this->navigateToQuizForm($quizId);
    }

    public function deleteQuiz() {
        $model = $this->getModel('Quizzes');
        $quizId = Factory::getApplication()->input->getInt('quizId');
        $model->deleteQuiz($quizId);
        $this->setRedirect(Route::_(Uri::getInstance()->current() . '?task=Display', false));
    }


    public function saveQuestion() {
        $model = $this->getModel('QuestionForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $feedback = Factory::getApplication()->input->post->getVar('feedback');

        $data = ['quizId' => $quizId, 'description' => $description, 'feedback' => $feedback];
        Factory::getApplication()->setUserState('myQuiz.questionForm', $data);

        // Perform server side validation
        if ($this->validateQuestion($description, $feedback)) {
            $model->saveQuestion($data);
            $this->navigateToAnswerForm(Factory::getDbo()->insertId());
        }
        // Validate failed. Reload form
        else {
            $this->navigateToQuestionForm($quizId);
        }      
    }

    public function updateQuestion() {
        $model = $this->getModel('QuestionForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $feedback = Factory::getApplication()->input->post->getVar('feedback');

        $data = array('quizId' => $quizId, 'questionId' => $questionId, 'description' => $description, 'feedback' => $feedback);
        Factory::getApplication()->setUserState('myQuiz.questionForm', $data);

        // Perform server side validation
        if ($this->validateQuestion($description, $feedback)) {
            if ($model->updateQuestion($data)) {
                // Successful update. Reload the form, questionId not needed.
                $this->navigateToQuestionForm($quizId);
            }
            // Update failed. Reload the form and input the questionId
            else {
                $this->navigateToQuestionForm($quizId, $questionId);
            }
        }
        else {
            $this->navigateToQuestionForm($quizId, $questionId);
        }     
    }

    public function deleteQuestion() {
        $model = $this->getModel('QuestionForm');
        $data = Factory::getApplication()->input->post->getArray();
        $model->deleteQuestion($data['questionId']);
        $this->navigateToQuestionForm($data['quizId']);
    }

    public function saveAnswer() {
        $model = $this->getModel('AnswerForm');

        // Perform post filtering
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $markValue = Factory::getApplication()->input->post->getInt('markValue');

        // Perform server side validation
        if ($this->validateAnswer($description, $markValue)) {          
            $data = array($questionId, $description, $markValue);
            $model->saveAnswer($data);
        }    
        $this->navigateToAnswerForm($questionId);
    }

    public function updateAnswer() {
        $model = $this->getModel('AnswerForm');
        $data = Factory::getApplication()->input->post->getArray();

        // Perform post filtering
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $answerId = Factory::getApplication()->input->post->getInt('answerId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $markValue = Factory::getApplication()->input->post->getInt('markValue');

        // Perform server side validation
        if($this->validateAnswer($description, $markValue)) {
            $data = array('questionId' => $questionId, 'answerId' => $answerId, 'description' => $description, 'markValue' => $markValue);
            
            if($model->updateAnswer($data)) {
                $this->navigateToAnswerForm($questionId);
            }
            else {
                $this->navigateToAnswerForm($questionId, $answerId);
            }
        }
        else {
            $this->navigateToAnswerForm($questionId, $answerId);
        }
    }

    public function deleteAnswer() {
        $model = $this->getModel('AnswerForm');
        $data = Factory::getApplication()->input->post->getArray();
        $model->deleteAnswer($data['answerId']);
        $this->navigateToAnswerForm($data['questionId']);
    }

    private function navigateToQuizForm($quizId = null) {
        $task = '?task=Display.quizForm';
        if ($quizId) {
            $task = $task . '&quizId=' . $quizId;
        }
        $this->setRedirect(Route::_(Uri::getInstance()->current() . $task, false));
    }

    private function navigateToQuestionForm($quizId = null, $questionId = null) {
        $task = '?task=Display.questionForm&quizId=' . $quizId;
        if ($questionId) {
            $task = $task . '&questionId=' . $questionId;
        }
        $this->setRedirect(Route::_(Uri::getInstance()->current() . $task, false));
    }

    private function navigateToAnswerForm($questionId = null, $answerId = null) {
        $task = '?task=Display.answerForm&questionId=' . $questionId;
        if ($answerId) {
            $task = $task . '&answerId=' . $answerId;
        }
        $this->setRedirect(Route::_(Uri::getInstance()->current() . $task, false));
    }

    private function validateQuiz($title, $imageId, $attemptsAllowed, $description) {
        if(empty($title)) {
            Factory::getApplication()->enqueueMessage("Title was empty. Please enter a quiz title.");
            return false;
        }
        if(empty($imageId)) {
            Factory::getApplication()->enqueueMessage("Please select an image.");
            return false;
        }
        if(empty($attemptsAllowed)) {
            Factory::getApplication()->enqueueMessage("Please enter an attempt limit");
            return false;
        }
        if($attemptsAllowed < 1) {
            Factory::getApplication()->enqueueMessage("There is a minimum of 1 attempt. Please enter an attempt limit");
            return false;
        }
        if($attemptsAllowed > 999) {
            Factory::getApplication()->enqueueMessage("There is a limit of 1000 attempts");
            return false;
        }
        return true;
    }

    private function validateQuestion($description, $feedback) {
        if(empty($description)) {
            Factory::getApplication()->enqueueMessage("Question was blank. Please describe the question.");
            return false;
        }
        if(strlen($description) > 200) {
            Factory::getApplication()->enqueueMessage("Question has a limit of 200 characters");
            return false;
        }

        if(strlen($feedback) > 200) {
            Factory::getApplication()->enqueueMessage("Feedback has a limit of 200 characters");
            return false;
        }
        return true;
    }

    private function validateAnswer($description, $markValue) {
        if(empty($description)) {
            Factory::getApplication()->enqueueMessage("Answer was blank. Please describe the answer");
            return false;
        }
        if(strlen($description) > 200) {
            Factory::getApplication()->enqueueMessage("Answer has a limit of 200 characters");
            return false;
        }
        if(!isset($markValue)) {
            Factory::getApplication()->enqueueMessage("Please enter a mark value");
            return false;
        }
        if ($markValue < -100 or $markValue > 100) {
            Factory::getApplication()->enqueueMessage("Please enter a mark value between -999 and 999");
            return false;
        }
        return true;
    }
    
}