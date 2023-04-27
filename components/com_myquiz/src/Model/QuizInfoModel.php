<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 *
 */

class QuizInfoModel extends ListModel {

    
    // Get a list of images filtered by category
    public function getItem() {

        $id = Factory::getApplication()->input->get('id');

        $item   = new \stdClass();

        
        $table  = $this->getTable('Quiz');
        $table->load($id);

        $item->id           =   $table->id;
        $item->title        =   $table->title;
        $item->description  =   $table->description;

        return $item;
    }


        
}