<?php

namespace Kieran\Component\MyQuiz\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 *
 */

class SaveAnswersModel extends BaseModel {

    
	public function saveAnswer($userId, $quizId, $questionNumber, $answerNumber) {
		
		$db = Factory::getDbo();      


		// Check if the question has already been answered
		$check = $db->getQuery(true)
			//Query
			->select('*')
			->from($db->quoteName('#__myQuiz_userAnswers', 'ua'))
			->where($db->quoteName('ua.userId') . '=' . $db->quote($userId) 
				. 'AND' . $db->quoteName('ua.quizId') . '=' . $db->quote($quizId)
				. 'AND' . $db->quoteName('ua.questionNumber') . '=' . $db->quote($questionNumber));


		$columns = array('userId','quizId','questionNumber', 'answerNumber');
		$data = [$userId, $quizId, $questionNumber, $answerNumber]; 

		// If the question hasn't already been answered, then it can be inserted
		if(!$check) {
			$query = $db->getQuery(true)
			->insert($db->quoteName('#__myQuiz_userAnswers'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		
			$db->setQuery($query);
			$result = $db->execute();

			return true;
		}

		// Delete the old question answer, so the new one can be added.
		else{
			$query = $db->getQuery(true)
				->delete($db->quoteName('#__myQuiz_userAnswers'))
				->where($db->quoteName('userId') . '=' . $db->quote($userId)
				. 'AND' . $db->quoteName('quizId') . '=' . $db->quote($quizId)
				. 'AND' . $db->quoteName('questionNumber') . '=' . $db->quote($questionNumber));
		

			try {
				$db->setQuery($query);
				$result = $db->execute();
			}
			catch (RuntimeException $e){
				echo $e->getMessage();
			}

			// If the deletion is successful, the new answer can be added.
			if($result) {
				$query = $db->getQuery(true)
				->insert($db->quoteName('#__myQuiz_userAnswers'))
				->columns($db->quoteName($columns))
				->values(implode(',', $db->quote($data)));
			
				$db->setQuery($query);
	
				$result = $db->execute();
				return true;
			}

			return false;
		}
		
	}


        
}