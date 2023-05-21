<?php

namespace Kieran\Component\MyImageViewer\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 */

class AdminAllImageModel extends ListModel {


    // Get a list of images
    public function getListQuery(){

        // Get a db connection.
        $db = $this->getDatabase();

        // Create a new query object.
        $query = $db->getQuery(true)
            ->select($db->quoteName(['i.id', 'i.imageName', 'c.categoryName', 'i.imageUrl', 'i.isHidden']))
            ->from($db->quoteName('#__myImageViewer_image', 'i'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_imageCategory', 'c') . 'ON' . $db->quoteName('c.id') . '=' . $db->quoteName('i.categoryId'));
        return $query;
    }


    public function getTable($type = 'Image', $prefix = '', $config = array()) {
		return Factory::getApplication()->bootComponent('com_myImageViewer')->getMVCFactory()->createTable($type);
	}


    public function checkHidden($imageId) {

        $table = $this->getTable();
        $table->load($imageId);

        $num = $table->isHidden;

        return $num;
    }


    public function setImageHiddenStatus($imageId, $hide) {
        $db = $this->getDatabase();
        
        $query = $db->getQuery(true)
            ->update($db->quoteName('#__myImageViewer_image'))
            ->set($db->quoteName('isHidden') . ' = ' . $db->quote($hide))
            ->where($db->quoteName('id') . ' = ' . $db->quote($imageId));
        
        $db->setQuery($query);
		
		try {
			$result = $db->execute();
            if($hide == 1) {
                Factory::getApplication()->enqueueMessage("Image hidden successfully.");
            }
            else{
                Factory::getApplication()->enqueueMessage("Image unhidden successfully.");
            }		
			return true;
		} catch (\Exception $e) {
			Factory::getApplication()->enqueueMessage("Error: An unknown error has occurred. Please contact your administrator.");
			return false;
		}
    }
        
}