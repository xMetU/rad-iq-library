<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class AllQuizModel extends ListModel {


    // Get a list of quizzes filtered by category
    public function getListQuery(){

        // Get a db connection.
        $db = $this->getDatabase();

        $category = Factory::getApplication()->input->get('category');

        // Create a new query object.
        $query = $db->getQuery(true)
                //Query
            ->select($db->quoteName(['q.id', 'q.title', 'q.description', 'q.imageId', 'i.imageUrl', 'q.attemptsAllowed']))
            ->from($db->quoteName('#__myQuiz_quiz', 'q'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_image', 'i') . 'ON' . $db->quoteName('i.id') . '=' . $db->quoteName('q.imageId')
            );

        if(isset($category)){
            $query = $query->where($db->quoteName('i.categoryId') . '=' . $category);
        }        

        return $query;
    }

        
}