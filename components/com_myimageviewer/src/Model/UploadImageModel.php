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

class UploadImageModel extends ListModel {


    public function getListQuery(){

        // Get a db connection.
        $db = $this->getDatabase();

        // Create a new query object.
        $query = $db->getQuery(true)
        
                //Query
                ->select('image.imageCategory')
                ->from($db->quoteName('#__myImageViewer_image', 'image'));

        // Check query is correct        
        echo $query;

        return $query;
    }

        
}