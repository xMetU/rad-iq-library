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
                $this->navigateToForm('QUESTION', Factory::getDbo()->insertId());
            } else {
                $this->navigateToForm('QUIZ');
            }         
        }
        else {
            $this->navigateToForm('QUIZ');
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

        // Perform server side validation
        if ($this->validateQuiz($title, $imageId, $attemptsAllowed, $description)) {
            $data = array('quizId' => $quizId, 'title' => $title, 'imageId' => $imageId, 'attemptsAllowed' => $attemptsAllowed, 'description' => $description);
            $model->updateQuiz($data);
        }
        $this->navigateToForm('QUIZ', $quizId);
    }

    public function deleteQuiz() {

        $model = $this->getModel('Quizzes');
        $quizId = Factory::getApplication()->input->getInt('quizId');
        $model->deleteQuiz($quizId);
        $this->navigateToForm();
    }


    public function saveQuestion() {

        $model = $this->getModel('QuestionForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $feedback = Factory::getApplication()->input->post->getVar('feedback');

        // Perform server side validation
        if($this->validateQuestion($description, $feedback)){
            $data = array($quizId, $description, $feedback);
            $model->saveQuestion($data);
            $this->navigateToForm('ANSWER', Factory::getDbo()->insertId());
        }
        // Validate failed. Reload form
        else{
            $this->navigateToForm('QUESTION', $quizId);
        }      
    }

    public function updateQuestion() {

        $model = $this->getModel('QuestionForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $feedback = Factory::getApplication()->input->post->getVar('feedback');

        // Perform server side validation
        if($this->validateQuestion($description, $feedback)) {
            $data = array('quizId' => $quizId, 'questionId' => $questionId, 'description' => $description, 'feedback' => $feedback);

            if($model->updateQuestion($data)) {
                // Successful update. Reload the form, questionId not needed.
                $this->navigateToForm('QUESTION', $quizId);
            }
            // Update failed. Reload the form and input the questionId
            else{
                $this->setRedirect(
                    Uri::getInstance()->current() . '?task=Display.questionForm&quizId=' . $quizId . '&questionId=' . $questionId
                );
            }
        }
        // Validation failed. Reload the form and input the questionId
        else{
            $this->setRedirect(
                Uri::getInstance()->current() . '?task=Display.questionForm&quizId=' . $quizId . '&questionId=' . $questionId
            );
        }     
    }


    public function deleteQuestion() {
        $model = $this->getModel('QuestionForm');
        $data = Factory::getApplication()->input->post->getArray();
        $model->deleteQuestion($data['questionId']);
        $this->navigateToForm('QUESTION', $data['quizId']);
    }


    public function saveAnswer() {
        $model = $this->getModel('AnswerForm');

        // Perform post filtering
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $markValue = Factory::getApplication()->input->post->getInt('markValue');

        // Perform server side validation
        if($this->validateAnswer($description, $markValue)) {          
            $data = array($questionId, $description, $markValue);
            $model->saveAnswer($data);
        }    
        $this->navigateToForm('ANSWER', $questionId);
        
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
                $this->navigateToForm('ANSWER', $questionId);
            }
            else{
                $this->setRedirect(
                    Uri::getInstance()->current() . '?task=Display.answerForm&questionId=' . $questionId . '&answerId=' . $answerId
                );
            }
        }    
        else{
            $this->setRedirect(
                Uri::getInstance()->current() . '?task=Display.answerForm&questionId=' . $questionId . '&answerId=' . $answerId
            );
        }
    }


    public function deleteAnswer() {
        $model = $this->getModel('AnswerForm');
        $data = Factory::getApplication()->input->post->getArray();
        $model->deleteAnswer($data['answerId']);
        $this->navigateToForm('ANSWER', $data['questionId']);
    }



    private function navigateToForm($form = "", $id = "") {
        switch ($form) {
            case 'QUIZ':
                $task = 'quizForm&quizId=';
                break;
            case 'QUESTION':
                $task = 'questionForm&quizId=';
                break;
            case 'ANSWER':
                $task = 'answerForm&questionId=';
                break;
            default:
                $task = 'display';
        }
        $this->setRedirect(Route::_(
            Uri::getInstance()->current() . '?task=Display.' . $task . $id,
            false
        ));
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