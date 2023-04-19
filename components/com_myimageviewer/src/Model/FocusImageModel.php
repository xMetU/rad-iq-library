<?php

namespace Kieran\Component\MyImageViewer\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 *
 */

class FocusImageModel extends ItemModel {

    // Retrieve the chosen image for focussed display.
    public function getItem($pk = null){

        $id = Factory::getApplication()->input->get('id');

        $item   = new \stdClass();

        
        $table  = $this->getTable('Image');
        $table->load($id);

        $item->id           =   $table->id;
        $item->name         =   $table->imageName;
        $item->category     =   $table->imageCategory;
        $item->description  =   $table->imageDescription;
        $item->url          =   $table->imageUrl;

        return $item;

    }

        
}