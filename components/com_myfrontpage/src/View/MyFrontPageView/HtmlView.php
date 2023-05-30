<?php

namespace Kieran\Component\MyFrontPage\Site\View\MyFrontPageView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myFrontPage
 */


class HtmlView extends BaseHtmlView {
    

    public function display($template = null) {

        // Call the parent display to display the layout file
        parent::display($template);
    }

}