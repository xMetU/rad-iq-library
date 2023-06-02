<?php

namespace Kieran\Component\MyQuiz\Site\View\QuizzesView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class HtmlView extends BaseHtmlView {
    
    public function display($template = null) {
        $this->items = $this->get('Items');
        $this->categories = $this->get('Items', 'Categories');

        $this->pagination = $this->get('Pagination');
        $this->category = Factory::getApplication()->input->get('category');
        $this->search = Factory::getApplication()->input->get('search');

        $this->userId = Factory::getUser()->id;

        parent::display($template);
    }

}