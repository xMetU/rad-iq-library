<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class AnswersModel extends ListModel {
    // Override global list limit so all answers are returned
    protected function populateState($ordering = null, $direction = null){
        $limit = 0;
        $this->setState('list.limit', $limit);
    }

    public function getListQuery() {
        $db = $this->getDatabase();

        $quizId = Factory::getApplication()->input->get('quizId');
        $questionNumber = Factory::getApplication()->input->get('questionNumber');

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__myQuiz_answer', 'a'))
            ->where($db->quoteName('a.quizId') . '=' . $db->quote($id))
            ->where($db->quoteName('a.questionNumber') . '=' . $db->quote($questionNumber));

        return $query;
    }

}