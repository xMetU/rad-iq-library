<?php

namespace Kieran\Component\MyImageViewer\Administrator\View\AdminImageView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 *
 */

class HtmlView extends BaseHtmlView {
    

    function display($tpl = null) {

        $this->items = $this->get('Items');

        parent::display($tpl);
    }

}