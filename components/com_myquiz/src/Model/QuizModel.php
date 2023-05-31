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
        $id = Factory::getApplication()->input->get('quizId');

        $item = new \stdClass();

        $table = $this->getTable('Quiz');
        $table->load($id);

        $item->id = $table->id;
        $item->imageId = $table->imageId;
        $item->title = $table->title;
        $item->description = $table->description;
        $item->attemptsAllowed = $table->attemptsAllowed;

        return $item;
    }
   
}