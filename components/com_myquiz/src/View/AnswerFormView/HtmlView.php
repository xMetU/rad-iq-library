<?php

namespace Kieran\Component\MyQuiz\Site\View\AnswerFormView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;


/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 *
 */

class HtmlView extends BaseHtmlView {
    
    public function display($template = null) {
        $this->items = $this->get('Items');

        $this->question = $this->get('Item', 'Question');
        if (Factory::getApplication()->input->getVar('answerId') != null) {
            $this->answer = $this->get('Item', 'Answer');
        } else {
            $this->answer = null;
        }

        parent::display($template);
    }

}