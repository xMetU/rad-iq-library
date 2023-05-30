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

class QuestionFormModel extends BaseModel {

	public function saveQuestion($data) {
		// TODO: Properly set questionNumber
		$db = Factory::getDbo();
        $columns = array('quizId', 'questionDescription', 'feedback', 'markValue');

		$query = $db->getQuery(true)
			->insert($db->quoteName('#__myQuiz_question'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		$db->setQuery($query);

		try {
			$db->execute();
			Factory::getApplication()->enqueueMessage("Question saved successfully.");
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
	}


	public function updateQuestion($data) {
		$db = Factory::getDbo();

		$query = $db->getQuery(true)
			->update($db->quoteName('#__myQuiz_question'))
			->set($db->quoteName('questionDescription') . ' = ' . $db->quote($data['questionDescription']))
			->set($db->quoteName('feedback') . ' = ' . $db->quote($data['feedback']))
			->set($db->quoteName('markValue') . ' = ' . $db->quote($data['markValue']))
			->where($db->quoteName('quizId') . ' = ' . $db->quote($data['quizId']))
            ->where($db->quoteName('questionNumber') . ' = ' . $db->quote($data['questionNumber']));
		$db->setQuery($query);
		
		try {
			$result = $db->execute();
			Factory::getApplication()->enqueueMessage("Question updated successfully.");
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
	}
}