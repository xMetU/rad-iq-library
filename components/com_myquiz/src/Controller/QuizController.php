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
 *
 */

class QuizController extends BaseController {
    
    public function startQuiz() {
        $userId = Factory::getUser()->id;    
        // Redirect to main menu if not logged in
        if ($userId) {
            // Check if user has allowed attempts left
            $data = Factory::getApplication()->input->getArray();
            $model = $this->getModel('UserAnswer');
            
            $userAttempts = $model->getAttemptCount($userId, $data['quizId']);

            // An attempt is allowed. Quiz can proceed
            if ($userAttempts < $data['attemptsAllowed']) {

                /** UserQuestionData is an array that stores arrays of userAnswerData. 
                  * User variables are loaded into UserState, which are persistant variables like php $_SESSION variables. 
                  * User data can be stored while undertaking the quiz, all answers can be saved on completion. */
                Factory::getApplication()->setUserState('myQuiz.userId', $userId);
                Factory::getApplication()->setUserState('myQuiz.userAnswers', array());
                Factory::getApplication()->setUserState('myQuiz.attemptNumber', $userAttempts + 1);
    
                $this->setRedirect(
                    Uri::getInstance()->current() 
                    . '?task=Display.quiz&quizId=' . $data['quizId']
                    . '&questionId=' . $data['questionId']
                );
            }
            else {
                Factory::getApplication()->enqueueMessage('You have reached the attempt limit for this quiz');
                $this->setRedirect(Uri::getInstance()->current() . '?&task=Display.display');
            }
        }
        else {
            Factory::getApplication()->enqueueMessage('Please login to continue');
            $this->setRedirect('?index.php');
        }
    }

    public function saveAnswer() {
        $data = Factory::getApplication()->input->getArray();
        $userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        if ($data['answerId']) {
            $userAnswers[$data['questionId']] = $data['answerId'];
        }
        Factory::getApplication()->setUserState('myQuiz.userAnswers', $userAnswers);

        if ($data['nextQuestionId'] == "FINISH") {
            $this->submitAnswers();
        } else {
            $this->setRedirect(
                Uri::getInstance()->current()
                . '?task=Display.quiz&quizId=' . $data['quizId']
                . '&questionId=' . $data['nextQuestionId']
            );
        }
    }

    private function submitAnswers() {
        $model = $this->getModel('UserAnswer');

        $quizId = Factory::getApplication()->input->getVar('quizId');
        $userId = Factory::getApplication()->getUserState('myQuiz.userId');
        $userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        $attemptNumber = Factory::getApplication()->getUserState('myQuiz.attemptNumber');

        foreach($userAnswers as $answerId) {
            $model->submitAnswer([$userId, $answerId, $attemptNumber]);
        }

        $model->generateSummary([$userId, $answerId, $attemptNumber]);

        $this->setRedirect(Uri::getInstance()->current() . '?task=Display.summaryDisplay&quizId=' . $quizId);
    }


    public function saveData() {

        $userId = Factory::getApplication()->getUserState('myQuiz.userUserId');       
        $quizId =  Factory::getApplication()->getUserState('myQuiz.userQuizId');

        // Get filtered data from post
        $questionNumber = Factory::getApplication()->input->post->getInt('questionNumber');
        $answerNumber = Factory::getApplication()->input->post->getInt('selectedAnswer');
        $count = Factory::getApplication()->input->post->getInt('count');

        $userAnswerData = array('userId' => $userId, 'quizId' => $quizId, 'questionNumber' => $questionNumber, 
                                'answerNumber' => $answerNumber, 'count' => $count);

        // Load the final question into the answer array.                        
        if($answerNumber) {
            $this->loadUserAnswer($userAnswerData, $questionNumber, $answerNumber);
        }
        
        // Save all the answers to the database
        $model = $this->getModel('SaveAnswers');
        $userQuestionData = Factory::getApplication()->getUserState('myQuiz.userQuestionData');
        $model->saveAnswers($userQuestionData);
        
        $this->setRedirect(Uri::getInstance()->current() . Route::_('?&quizId=' . $quizId . '&task=Display.summaryDisplay', false));
    }


}