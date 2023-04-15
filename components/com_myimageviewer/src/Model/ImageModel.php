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

class ImageModel extends ListModel {


    public function getListQuery(){

        // Get a db connection.
        $db = $this->getDatabase();

        // Create a new query object.
        $query = $db->getQuery(true)
        
                //Query
                ->select('*')
                ->from($db->quoteName('#__myImageViewer_image', 'image'));
                // ->where($db->quoteName('image.imageCategory') . '=' . $db->quote('Chest'));

        // Check query is correct        
        echo $query;

        return $query;
    }
        
}