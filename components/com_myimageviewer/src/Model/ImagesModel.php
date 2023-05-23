<?php

namespace Kieran\Component\MyImageViewer\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 *
 */

class ImagesModel extends ListModel {

    public function getListQuery() {
        $db = $this->getDatabase();

        $categoryId = Factory::getApplication()->input->getInt('categoryId');
        $newCategoryId = Factory::getApplication()->getUserState('myImageViewer.categoryId');

        $query = $db->getQuery(true)
            ->select($db->quoteName(['image.imageName', 'image.imageUrl', 'image.id', 'isHidden']))
            ->from($db->quoteName('#__myImageViewer_image', 'image'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_imageCategory', 'c') . 'ON' . $db->quoteName('c.id') . '=' . $db->quoteName('image.categoryId'));
        
        // Modify query based on whether a category is selected
        if (isset($categoryId)) {
            if($newCategoryId != $categoryId) {
                $query->where($db->quoteName('c.id') . '=' . $db->quote($categoryId));
                $newCategoryId = Factory::getApplication()->setUserState('myImageViewer.categoryId', $categoryId);
            }
            else{
                Factory::getApplication()->setUserState('myImageViewer.categoryId', 0);
            }
        }
        
        return $query;
    }

    // Override global list limit so all images are displayed
    protected function populateState($ordering = null, $direction = null){
        $this->setState('list.limit', 0);
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