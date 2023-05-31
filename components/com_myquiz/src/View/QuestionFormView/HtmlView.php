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
        $this->quizId = Factory::getApplication()->input->getVar('quizId');
        if (Factory::getApplication()->input->getVar('questionId') != null) {
            $this->question = $this->get('Item');
        } else {
            $this->question = null;
        }

        parent::display($template);
    }

}