<?php

namespace Kieran\Component\MyQuiz\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 */

class AdminAllQuizModel extends ListModel {


    // Get a list of quizzes 
    public function getListQuery(){

        // Get a db connection.
        $db = $this->getDatabase();

        // Create a new query object.
        $query = $db->getQuery(true)
            ->select($db->quoteName(['q.id', 'q.title', 'q.description', 'q.imageId', 'i.imageUrl', 'q.isHidden']))
            ->from($db->quoteName('#__myQuiz_quiz', 'q'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_image', 'i') . 'ON' . $db->quoteName('i.id') . '=' . $db->quoteName('q.imageId'));

        return $query;
    }

    public function getTable($type = 'Quiz', $prefix = '', $config = array()) {
		return Factory::getApplication()->bootComponent('com_myQuiz')->getMVCFactory()->createTable($type);
	}


    public function checkHidden($quizId) {

        $table = $this->getTable();
        $table->load($quizId);

        $num = $table->isHidden;

        return $num;
    }

    public function setQuizHiddenStatus($quizId, $hide) {
        $db = $this->getDatabase();
        
        $query = $db->getQuery(true)
            ->update($db->quoteName('#__myQuiz_quiz'))
            ->set($db->quoteName('isHidden') . ' = ' . $db->quote($hide))
            ->where($db->quoteName('id') . ' = ' . $db->quote($quizId));
        
        $db->setQuery($query);
		
		try {
			$result = $db->execute();
            if($hide == 1) {
                Factory::getApplication()->enqueueMessage("Quiz hidden successfully.");
            }
            else{
                Factory::getApplication()->enqueueMessage("Quiz unhidden successfully.");
            }		
			return true;
		} catch (\Exception $e) {
			Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
    }
        
}