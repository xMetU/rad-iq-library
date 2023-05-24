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

        $category = Factory::getApplication()->input->getVar('category');

        $query = $db->getQuery(true)
            ->select($db->quoteName(['image.imageName', 'image.imageUrl', 'image.id']))
            ->from($db->quoteName('#__myImageViewer_image', 'image'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_imageCategory', 'c') . 'ON' . $db->quoteName('c.id') . '=' . $db->quoteName('image.categoryId')
            );

        if (isset($category)) {
            $query = $query->where($db->quoteName('c.id') . '=' . $category);
        }
            
        return $query;
    }

    // Override global list limit so all images are displayed
    protected function populateState($ordering = null, $direction = null){
        $this->setState('list.limit', 0);
    }

}