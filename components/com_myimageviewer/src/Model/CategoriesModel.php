<?php

namespace Kieran\Component\MyImageViewer\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 */


class CategoriesModel extends ListModel {

    public function getListQuery() {

        $db = $this->getDatabase();
        $catSearch = Factory::getApplication()->input->get('catSearch');

        $query = $db->getQuery(true)
            ->select($db->quoteName(['ic.id', 'ic.categoryName']))
            ->from($db->quoteName('#__myImageViewer_imageCategory', 'ic'));

        if(isset($catSearch)) {
            $query = $query->where($db->quoteName('ic.categoryName') . ' LIKE ' . $db->quote('%' . $catSearch . '%'));
        }
        
        return $query;
    }


    // Override global list limit so all categories are displayed
    protected function populateState($ordering = null, $direction = null){
        $limit = 0;
        $this->setState('list.limit', $limit);
    }
}