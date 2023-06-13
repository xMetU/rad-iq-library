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

        $questionId = Factory::getApplication()->input->get('questionId');

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__myQuiz_answer', 'a'))
            ->where($db->quoteName('a.questionId') . '=' . $db->quote($questionId));

        return $query;
    }


    // List query retrieves items from the cache if it can, which can't be used in a loop. This is loop friendly version.
    public function getAnswers() {

        $db = $this->getDatabase();

        $questionId = Factory::getApplication()->input->get('questionIdCounter');

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__myQuiz_answer', 'a'))
            ->where($db->quoteName('a.questionId') . '=' . $db->quote($questionId));
        
        $db->setQuery($query);
        $db->execute();
                
        return $db->loadObjectList();

    }

}