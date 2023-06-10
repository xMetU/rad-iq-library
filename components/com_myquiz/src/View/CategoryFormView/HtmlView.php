<?php

namespace Kieran\Component\MyQuiz\Site\View\CategoryFormView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class HtmlView extends BaseHtmlView {


    public function display($template = null) {
        
        $this->categories = $this->get('Items', 'Categories');

        // Call the parent display to display the layout file
        parent::display($template);
    }

}