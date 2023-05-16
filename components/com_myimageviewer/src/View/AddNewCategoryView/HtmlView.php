<?php

namespace Kieran\Component\MyImageViewer\Site\View\AddNewCategoryView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;


/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 */

class HtmlView extends BaseHtmlView {
    

    public function display($template = null) {
        
        $this->form = $this->get('Form');


        // Call the parent display to display the layout file
        parent::display($template);
    }

}