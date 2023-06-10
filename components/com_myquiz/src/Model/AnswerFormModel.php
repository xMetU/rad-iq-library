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

class AnswerFormModel extends BaseModel {

	public function saveAnswer($questionId, $description, $isCorrect) {
		$db = Factory::getDbo();
        $columns = array('questionId', 'description', 'isCorrect');
		$data = ['questionId' => $questionId, 'description' => $description, 'isCorrect' => $isCorrect];

		if ($data['isCorrect']) {
			$query = $db->getQuery(true)
				->update($db->quoteName('#__myQuiz_answer'))
				->set($db->quoteName('isCorrect') . ' = ' . $db->quote(0))
				->where($db->quoteName('questionId') . ' = ' . $db->quote($data['questionId']));
			$db->setQuery($query);
			$db->execute();
		}

		$query = $db->getQuery(true)
			->insert($db->quoteName('#__myQuiz_answer'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		$db->setQuery($query);

		try {
			$db->execute();
			if ($data['isCorrect']) {
				Factory::getApplication()->enqueueMessage("Answer saved successfully, correct answer updated.");
			} else {
				Factory::getApplication()->enqueueMessage("Answer saved successfully.");
			}
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage());
			return false;
		}
	}

	public function updateAnswer($questionId, $answerId, $description, $isCorrect) {
		$db = Factory::getDbo();
		$data = ['questionId' => $questionId, 'answerId' => $answerId, 'description' => $description, 'isCorrect' => $isCorrect];

		if ($data['isCorrect']) {
			$query = $db->getQuery(true)
				->update($db->quoteName('#__myQuiz_answer'))
				->set($db->quoteName('isCorrect') . ' = ' . $db->quote(0))
				->where($db->quoteName('questionId') . ' = ' . $db->quote($data['questionId']));
			$db->setQuery($query);
			$db->execute();
		}

		$query = $db->getQuery(true)
			->update($db->quoteName('#__myQuiz_answer'))
			->set($db->quoteName('description') . ' = ' . $db->quote($data['description']))
			->set($db->quoteName('isCorrect') . ' = ' . $db->quote($data['isCorrect']))
            ->where($db->quoteName('id') . ' = ' . $db->quote($data['answerId']));
		$db->setQuery($query);
		
		try {
			$result = $db->execute();
			if ($data['isCorrect']) {
				Factory::getApplication()->enqueueMessage("Answer updated successfully, correct answer updated.");
			} else {
				Factory::getApplication()->enqueueMessage("Answer updated successfully.");
			}
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
	}

	public function deleteAnswer($answerId) {
		$db = Factory::getDbo();
		
		$query = $query = $db->getQuery(true)
            ->delete($db->quoteName('#__myQuiz_answer'))
            ->where($db->quoteName('id') . '=' . $db->quote($answerId));
        $db->setQuery($query);

		try {
			$result = $db->execute();
			Factory::getApplication()->enqueueMessage("Answer deleted successfully.");
			return true;
		} catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
	}
}