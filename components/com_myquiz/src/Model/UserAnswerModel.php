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
        $attemptNumber = Factory::getApplication()->getUserState('myQuiz.userAttemptNumber');

        try {
            $query = $db->getQuery(true)
                ->select('*')
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
            Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
        }
    }

    public function generateSummary($data) {
        $db = Factory::getDbo();

        $query = $db->getQuery(true);
    }

    public function getAttemptCount($userId, $quizId) {
        $db = Factory::getDbo();

        $query = $db->getQuery(true)
            ->select('COUNT(*) AS attemptCount')
            ->from($db->quoteName('#__myQuiz_quizUserSummary', 'qus'))
            ->where($db->quoteName('qus.userId') . '=' . $db->quote($userId))
            ->where($db->quoteName('qus.quizId') . '=' . $db->quote($quizId));
        $result = $db->setQuery($query)->loadObject();

        Factory::getApplication()->enqueueMessage($result->attemptCount);

        return $result->attemptCount;
    }

    protected function populateState($ordering = null, $direction = null){
        $limit = 0;
        $this->setState('list.limit', $limit);
    }
   
}