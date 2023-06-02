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
            $model = $this->getModel('Quiz');
            
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
            $this->setRedirect(Route::_('?index.php', false));
        }
    }

    public function navigateToQuestion() {
        $urlData = Factory::getApplication()->input->getArray();
        $postData = Factory::getApplication()->input->getArray();

        $this->saveAnswer($postData);

        $this->setRedirect(
            Uri::getInstance()->current()
            . '?task=Display.quiz&quizId=' . $urlData['quizId']
            . '&questionId=' . $urlData['questionId']
        );
    }

    public function saveAnswer($data) {
        $userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        $userAnswers[$data['questionId']] = $data['answerId'];
        Factory::getApplication()->setUserState('myQuiz.userAnswers', $userAnswers);
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