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

class ImageCategoriesDisplayModel extends ListModel {

    
    // Get a list of images filtered by category
    public function getListQuery(){

        // Factory::getApplication()->enqueueMessage("imageDisplayModel changeCategory()");

        // Get a db connection.
        $db = $this->getDatabase();

        $imageCategory = Factory::getApplication()->input->get('imageCategory');       

        // Create a new query object.
        $query = $db->getQuery(true)
                //Query
                ->select($db->quoteName(['image.imageUrl', 'image.imageCategory', 'image.id']))
                ->from($db->quoteName('#__myImageViewer_image', 'image'))
                ->where($db->quoteName('image.imageCategory') . '=' . $db->quote($imageCategory));

        // Check query is correct        
        // echo $query->dump();

        return $query;
    }


        
}