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

class UploadImageModel extends BaseModel {

	public function getTable($type = 'ImageCategory', $prefix = '', $config = array()) {
		return Factory::getApplication()->bootComponent('com_myImageViewer')->getMVCFactory()->createTable($type);
	}

	public function getCategory($categoryId)  { 
        $item = new \stdClass();

        $table = $this->getTable();
        $table->load($categoryId);

        $item->categoryName = $table->categoryName;
        return $item;	
	}

	public function saveImage($data) {
		$db = Factory::getDbo();      
		$columns = array('imageName','imageDescription','categoryId', 'imageUrl');
		
		$query = $db->getQuery(true)
			->insert($db->quoteName('#__myImageViewer_image'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		
		$db->setQuery($query);
		$result = $db->execute();
	}

	public function updateImage($data, $imageId) {
		$db = Factory::getDbo();
		$columns = array('imageName', 'imageDescription', 'categoryId', 'imageUrl');

		$query = $db->getQuery(true)
			->update($db->quoteName('#__myImageViewer_image'))
			->set($db->quoteName($columns[0]) . ' = ' . $db->quote($data[0]))
			->set($db->quoteName($columns[1]) . ' = ' . $db->quote($data[1]))
			->set($db->quoteName($columns[2]) . ' = ' . $db->quote($data[2]))
			->set($db->quoteName($columns[3]) . ' = ' . $db->quote($data[3]))
			->where($db->quoteName('imageId') . ' = ' . (int) $imageId);

		$db->setQuery($query);
		$result = $db->execute();
}

	public function deleteImage($imageId) {
		$db = Factory::getDbo();      
		$columns = array('imageName','imageDescription','categoryId', 'imageUrl');
		
		$query = $db->getQuery(true)
			->delete($db->quoteName('#__myImageViewer_image'))
			->where($db->quoteName('imageId') . '=' . (int) $imageId);
		
		$db->setQuery($query);
		$result = $db->execute();
	}
        
}