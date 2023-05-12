<?php

namespace Kieran\Component\MyImageViewer\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 *
 */

class AddNewCategoryModel extends BaseModel {

	public function getTable($type = 'ImageCategory', $prefix = '', $config = array()) {
		return Factory::getApplication()->bootComponent('com_myImageViewer')->getMVCFactory()->createTable($type);
	}

    /**
	 * Method to get the record form.
	 *
	 * @param array    $data      Data for the form.
	 * @param boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A Form object on success, false on failure
	 */
	public function saveCategory($data) {
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->insert($db->quoteName('#__myImageViewer_imageCategory'))
			->columns($db->quoteName(['categoryName']))
			->values(implode(',', $db->quote($data)));
		$db->setQuery($query);

		try {
			$db->execute();
			Factory::getApplication()->enqueueMessage("Category saved successfully.");
			return true;
		} catch (\Exception $e) {
			$message = $e->getMessage();
            // TODO: better error messages
			Factory::getApplication()->enqueueMessage("Error: " . $message);
			return false;
		}
	}

	public function deleteCategory($categoryId) {
		$db = Factory::getDbo();
		$query = $db->getQuery(true)
			->delete($db->quoteName('#__myImageViewer_imageCategory'))
			->where($db->quoteName('id') . '=' . (int) $categoryId);
		$db->setQuery($query);
			
		try {
			$db->execute();
			Factory::getApplication()->enqueueMessage("Category deleted successfully.");
			return true;
		}
		catch (\Exception $e) {
			$message = $e->getMessage();
            // TODO: better error messages
			Factory::getApplication()->enqueueMessage("Error: " . $message);
			return false;
		}
	}

}