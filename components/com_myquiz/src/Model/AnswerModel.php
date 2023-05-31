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

class AnswerModel extends ItemModel {

    public function getItem($pk = null) {
        $db = $this->getDatabase();

        $answerId = Factory::getApplication()->input->get('answerId');

        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__myQuiz_answer', 'a'))
            ->where($db->quoteName('q.id') . '=' . $db->quote($answerId));

        $result = $db->setQuery($query)->loadObject();

        return $result;
    }
   
}