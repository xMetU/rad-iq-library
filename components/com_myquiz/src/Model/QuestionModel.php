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

class QuestionModel extends ItemModel {

    public function getItem($pk = null) {
        $db = $this->getDatabase();

        $quizId = Factory::getApplication()->input->get('quizId');
        $questionNumber = Factory::getApplication()->input->get('questionNumber');

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__myQuiz_question', 'q'))
            ->where($db->quoteName('q.quizId') . '=' . $db->quote($quizId))
            ->where($db->quoteName('q.questionNumber') . '=' . $db->quote($questionNumber));

        $result = $db->setQuery($query)->loadObject();

        return $result;
    }
   
}