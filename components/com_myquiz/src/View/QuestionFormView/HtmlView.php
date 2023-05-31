<?php

namespace Kieran\Component\MyQuiz\Site\View\QuestionFormView;

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

        $this->quiz = $this->get('Item', 'Quiz');
        if (Factory::getApplication()->input->getVar('questionId') != null) {
            $this->question = $this->get('Item', 'Question');
        } else {
            $this->question = null;
        }

        parent::display($template);
    }

}