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
        $this->categories = $this->get('Items', 'Categories');
        $this->items = $this->get('Items');
        $this->allImages = $this->get('AllImages');
        $this->pagination = $this->get('Pagination');

        $this->category = Factory::getApplication()->input->getVar('category');
        $this->catSearch = Factory::getApplication()->input->getVar('catSearch');
        $this->search = Factory::getApplication()->input->getVar('search');
        
        // Call the parent display to display the layout file
        parent::display($template);
    }

}