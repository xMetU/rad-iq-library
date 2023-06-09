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
            $model = $this->getModel('UserAnswers');
            
            $userAttempts = $model->getAttemptCount($userId, $data['quizId']);

            // An attempt is allowed. Quiz can proceed
            if ($userAttempts < $data['attemptsAllowed']) {

                /** UserQuestionData is an array that stores arrays of userAnswerData. 
                  * User variables are loaded into UserState, which are persistant variables like php $_SESSION variables. 
                  * User data can be stored while undertaking the quiz, all answers can be saved on completion. */
                Factory::getApplication()->setUserState('myQuiz.userId', $userId);
                Factory::getApplication()->setUserState('myQuiz.userAnswers', array());
                Factory::getApplication()->setUserState('myQuiz.attemptNumber', $userAttempts + 1);
                Factory::getApplication()->setUserState('myQuiz.startTime', date("Y-m-d H:i:s"));
    
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
        $model = $this->getModel('UserAnswers');

        $quizId = Factory::getApplication()->input->getVar('quizId');
        $userId = Factory::getApplication()->getUserState('myQuiz.userId');
        $userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        $attemptNumber = Factory::getApplication()->getUserState('myQuiz.attemptNumber');
        $startTime = Factory::getApplication()->getUserState('myQuiz.startTime');
        $finishTime = date("Y-m-d H:i:s");

        foreach ($userAnswers as $answerIds) {
            foreach ($answerIds as $answerId) {
                $model->submitAnswer([$userId, $answerId, $attemptNumber]);
            }
        }

        $model->generateSummary([
            'userId' => $userId, 'quizId' => $quizId, 'attemptNumber' => $attemptNumber,
            'startTime' => $startTime, 'finishTime' => $finishTime,
        ]);

        $this->setRedirect(
            Uri::getInstance()->current()
            . '?task=Display.summary&quizId=' . $quizId
            . '&attemptNumber=' . $attemptNumber
        );
    }

}