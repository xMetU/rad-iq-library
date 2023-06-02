<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */


class QuizModel extends ItemModel {

    public function getItem($pk = null) {
        $db = $this->getDatabase();

        $quizId = Factory::getApplication()->input->get('quizId');

        $query = $db->getQuery(true)
            ->select(['q.*', 'i.imageUrl'])
            ->from($db->quoteName('#__myQuiz_quiz', 'q'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_image', 'i') . 'ON' . $db->quoteName('i.id') . '=' . $db->quoteName('q.imageId'),
            )
            ->where($db->quoteName('q.id') . '=' . $db->quote($quizId));

        $result = $db->setQuery($query)->loadObject();

        return $result;
    }

    public function saveUserAnswer() {

    }

    public function submitUserAnswers() {
        
    }

    public function getAttemptCount($userId, $quizId) {
        $db = $this->getDatabase();

        $query = $db->getQuery(true)
            ->select('COUNT(*) AS attemptCount')
            ->from($db->quoteName('#__myQuiz_quizUserSummary', 'qus'))
            ->where($db->quoteName('qus.userId') . '=' . $db->quote($userId))
            ->where($db->quoteName('qus.quizId') . '=' . $db->quote($quizId));

        $result = $db->setQuery($query)->loadObject();

        return $result->attemptCount;
    }
   
}