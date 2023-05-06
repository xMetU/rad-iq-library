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

	public function getImageData($pk = null) {
       	$id = Factory::getApplication()->input->get('id');
        $item   = new \stdClass();

        $table1  = $this->getTable('Image');
        $table1->load($id);

        $table2 = $this->getTable('ImageCategory');
        $table2->load($table1->categoryId);

        $item->id = $table1->id;
        $item->name = $table1->imageName;
        $item->category = $table2->categoryName;
        $item->description = $table1->imageDescription;
        $item->url = $table1->imageUrl;

        return $item;
    }

	public function saveImage($data) {
		$db = Factory::getDbo();
		$columns = array('imageName', 'categoryId', 'imageUrl', 'imageDescription');
		
		$query = $db->getQuery(true)
			->insert($db->quoteName('#__myImageViewer_image'))
			->columns($db->quoteName($columns))
			->values(implode(',', $db->quote($data)));
		
		$db->setQuery($query);
		$result = $db->execute();
	}

	public function deleteImage($imageId) {
		try {
			$db = Factory::getDbo();
			$query = $db->getQuery(true)
				->delete($db->quoteName('#__myImageViewer_image'))
				->where($db->quoteName('id') . '=' . (int) $imageId);
			$db->setQuery($query);
			$db->execute();
			Factory::getApplication()->enqueueMessage("Image deleted successfully.");
			return true;
		}
		catch (Exception $e) {
			Factory::getApplication()->enqueueMessage("Error when deleting image: " . $e->getMessage());
			return false;
		}
	}
        
}