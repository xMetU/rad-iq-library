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

    public function getListQuery() {
        $db = $this->getDatabase();

        $categories = Factory::getApplication()->input->getVar('categories');
        if (!isset($categories)) {
            $categories = "0";
        }

        $query = $db->getQuery(true)
            ->select($db->quoteName(['image.imageName', 'image.imageUrl', 'c.categoryName', 'image.id']))
            ->from($db->quoteName('#__myImageViewer_image', 'image'))
            ->join(
                'LEFT',
                $db->quoteName('#__myImageViewer_imageCategory', 'c') . 'ON' . $db->quoteName('c.id') . '=' . $db->quoteName('image.id')
            )
            ->where($db->quoteName('c.id') . 'IN(' . $categories . ')');

        return $query;
    }

}