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

        // Perform server side validation
        if($this->validateQuiz($title, $imageId, $attemptsAllowed, $description)) {
            if($model->saveQuiz($title, $imageId, $attemptsAllowed, $description)){
                $this->navigateToForm('QUESTION', Factory::getDbo()->insertId());
            }
            //Error
            else{
                $this->navigateToForm('QUIZ', Factory::getDbo()->insertId());
            }          
        }
        //Error
        else{
            $this->navigateToForm('QUIZ', Factory::getDbo()->insertId());
        }     
    }


    public function updateQuiz() {

        $model = $this->getModel('QuizForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $title = Factory::getApplication()->input->post->getVar('title');
        $imageId = Factory::getApplication()->input->post->getInt('imageId');
        $attemptsAllowed = Factory::getApplication()->input->post->getInt('attemptsAllowed');
        $description = Factory::getApplication()->input->post->getVar('description');

        // Perform server side validation
        if($this->validateQuiz($title, $imageId, $attemptsAllowed, $description)) {
            if($model->updateQuiz($quizId, $title, $imageId, $attemptsAllowed, $description)) {
                $this->navigateToForm('QUESTION', $quizId);
            }  
            //Error
            else{
                $this->navigateToForm('QUIZ', $quizId);
            }                     
        }
        //Error
        else{
            $this->navigateToForm('QUIZ', $quizId);
        }
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
        $markValue = Factory::getApplication()->input->post->getInt('markValue');

        // Perform server side validation
        if($this->validateQuestion($description, $feedback, $markValue)){
            $model->saveQuestion($quizId, $description, $feedback, $markValue);
        }
        $this->navigateToForm('QUESTION', $quizId);
    }


    public function updateQuestion() {
        $model = $this->getModel('QuestionForm');

        // Perform post filtering
        $quizId = Factory::getApplication()->input->post->getInt('quizId');
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $feedback = Factory::getApplication()->input->post->getVar('feedback');
        $markValue = Factory::getApplication()->input->post->getInt('markValue');

        // Perform server side validation
        if($this->validateQuestion($description, $feedback, $markValue)) {
            if($model->updateQuestion($quizId, $questionId, $description, $feedback, $markValue)) {
                $this->navigateToForm('QUESTION', $quizId);
            }
            else{
                $this->setRedirect(
                    Uri::getInstance()->current() . '?task=Display.questionForm&quizId=' . $quizId . '&questionId=' . $questionId
                );
            }
        }
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
        $isCorrect = Factory::getApplication()->input->post->getInt('isCorrect');

        // Perform server side validation
        if($this->validateAnswer($description)) {
            if($model->saveAnswer($questionId, $description, $isCorrect)) {
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


    public function updateAnswer() {
        $model = $this->getModel('AnswerForm');

        // Perform post filtering
        $questionId = Factory::getApplication()->input->post->getInt('questionId');
        $answerId = Factory::getApplication()->input->post->getInt('answerId');
        $description = Factory::getApplication()->input->post->getVar('description');
        $isCorrect = Factory::getApplication()->input->post->getInt('isCorrect');


        // Perform server side validation
        if($this->validateAnswer($description)) {
            if($model->updateAnswer($questionId, $answerId, $description, $isCorrect)) {
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
        $this->setRedirect(
            Uri::getInstance()->current() . '?task=Display.' . $task . $id
        );
    }


    private function validateQuiz($title, $imageId, $attemptsAllowed, $description) {

        if(empty($title)) {
            Factory::getApplication()->enqueueMessage("Please enter a quiz title.");
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


    private function validateQuestion($description, $feedback, $markValue) {

        if(empty($description)) {
            Factory::getApplication()->enqueueMessage("Please describe the question.");
            return false;
        }
        if(strlen($description) > 200) {
            Factory::getApplication()->enqueueMessage("Question has a limit of 200 characters");
            return false;
        }
        if(empty($markValue)) {
            Factory::getApplication()->enqueueMessage("Please enter a mark value");
            return false;
        }
        if($markValue < 1) {
            Factory::getApplication()->enqueueMessage("There is a minimum of 1 mark. Please enter a mark value");
            return false;
        }
        if($markValue > 999) {
            Factory::getApplication()->enqueueMessage("There is a limit of 999 marks for a question");
            return false;
        }
        return true;
    }


    private function validateAnswer($description) {

        if(empty($description)) {
            Factory::getApplication()->enqueueMessage("Please describe the answer.");
            return false;
        }
        if(strlen($description) > 200) {
            Factory::getApplication()->enqueueMessage("Answer has a limit of 200 characters");
            return false;
        }
        return true;
    }
    
}