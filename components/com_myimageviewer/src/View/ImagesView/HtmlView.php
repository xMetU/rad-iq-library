<?php

namespace Kieran\Component\MyImageViewer\Site\View\ImagesView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 */

class HtmlView extends BaseHtmlView {


    public function display($template = null) {
        $this->allImages = $this->get('AllImages');
        $this->categories = $this->get('Items', 'Categories');
        $this->subcategories = $this->get('Items', 'SubCategories');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        $this->category = Factory::getApplication()->getUserState('myImageViewer_myQuiz.category');
        $this->subcategory = Factory::getApplication()->input->getVar('subcategory');
        $this->catSearch = Factory::getApplication()->input->getVar('catSearch');
        $this->search = Factory::getApplication()->input->getVar('search');
        // Call the parent display to display the layout file
        parent::display($template);
    }

}