<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */


class UserAnswerModel extends ListModel {

    public function getListQuery() {
        $db = $this->getDatabase();

        $userId = Factory::getUser()->id;
        $quizId = Factory::getApplication()->input->get('quizId');
        $attemptNumber = Factory::getApplication()->getUserState('myQuiz.attemptNumber');

        try {
            $query = $db->getQuery(true)
                ->select(['q.description AS questionDescription', 'q.feedback', 'q.markValue', 'a.isCorrect', 'a.description AS answerDescription'])
                ->from($db->quoteName('#__myQuiz_userAnswers', 'ua'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__myQuiz_answer', 'a') . 'ON' . $db->quoteName('a.id') . '=' . $db->quoteName('ua.answerId')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__myQuiz_question', 'q') . 'ON' . $db->quoteName('q.id') . '=' . $db->quoteName('a.questionId')
                )
                ->where($db->quoteName('ua.userId') . '=' . $db->quote($userId))
                ->where($db->quoteName('q.quizId') . '=' . $db->quote($quizId))
                ->where($db->quoteName('ua.attemptNumber') . '=' . $db->quote($attemptNumber));
        } catch (\Exception $e) {
			echo $e->getMessage();
		}       

        return $query;
    }

    public function submitAnswer($data) {
        $db = Factory::getDbo();

        $columns = ['userId', 'answerId', 'attemptNumber'];

        $query = $db->getQuery(true)
			->insert($db->quoteName('#__myQuiz_userAnswers'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		$db->setQuery($query);

        try {
			$db->execute();
			Factory::getApplication()->enqueueMessage("Quiz results saved successfully.");
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage());
			return false;
        }
    }

    public function generateSummary($data, $answers) {
        $db = Factory::getDbo();

        $columns = ['userId', 'quizId', 'attemptNumber',  'startTime', 'finishTime', 'score', 'maxScore'];

        // Get the score
        $query = $db->getQuery(true)
            ->select(['SUM(q.markValue) AS score'])
            ->from($db->quoteName('#__myQuiz_question', 'q'))
            ->join(
                'LEFT',
                $db->quoteName('#__myQuiz_answer', 'a') . 'ON' . $db->quoteName('a.questionId') . '=' . $db->quoteName('q.id')
            )
            ->where($db->quoteName('q.quizId') . '=' . $db->quote($data['quizId']))
            ->where($db->quoteName('a.id') . 'IN(' . implode(',', array_values($answers)) . ')')
            ->where($db->quoteName('a.isCorrect') . '=' . $db->quote(1));
        $score = $db->setQuery($query)->loadObject()->score;
        if (!$score) {
            $score = 0;
        }
        
        // Get the total score
        $query = $db->getQuery(true)
            ->select('SUM(q.markValue) AS totalMarkValue')
            ->from($db->quoteName('#__myQuiz_question', 'q'))
            ->where($db->quoteName('q.quizId') . '=' . $db->quote($data['quizId']));
        $maxScore = $db->setQuery($query)->loadObject()->totalMarkValue;
        
        // Add the scores to the summary
        array_push($data, $score, $maxScore);
        
        // Add the summary
        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__myQuiz_quizUserSummary'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $db->quote($data)));
        $db->setQuery($query);
        try {
            $db->execute();
        } catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage());
        }
        
    }

    public function getAttemptCount($userId, $quizId) {
        $db = Factory::getDbo();

        $query = $db->getQuery(true)
            ->select('COUNT(*) AS attemptCount')
            ->from($db->quoteName('#__myQuiz_quizUserSummary', 'qus'))
            ->where($db->quoteName('qus.userId') . '=' . $db->quote($userId))
            ->where($db->quoteName('qus.quizId') . '=' . $db->quote($quizId));
        $result = $db->setQuery($query)->loadObject();

        return $result->attemptCount;
    }

    protected function populateState($ordering = null, $direction = null){
        $limit = 0;
        $this->setState('list.limit', $limit);
    }
   
}