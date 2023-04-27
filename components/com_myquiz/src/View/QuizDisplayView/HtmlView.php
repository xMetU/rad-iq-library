<?php

namespace Kieran\Component\MyQuiz\Site\View\QuizDisplayView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;


/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 *
 */

class HtmlView extends BaseHtmlView {
    

    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {


        $this->item = $this->get('Item');
        $this->items = $this->get('Items', 'QuizQuestions');


        $this->pagination = $this->get('Pagination');


        // Call the parent display to display the layout file
        parent::display($template);
    }

}