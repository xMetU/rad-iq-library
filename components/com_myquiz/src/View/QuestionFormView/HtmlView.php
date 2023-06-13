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

        foreach($this->items as $item) {
            $item->count = 0;
            Factory::getApplication()->input->set('questionIdCounter', $item->id);
            $this->answers = $this->getModel('Answers')->getAnswers();
            foreach($this->answers as $answer) {
                $item->count++;
            }
        }

        $this->quiz = $this->get('Item', 'Quiz');
        if ($questionId = Factory::getApplication()->input->getVar('questionId')) {
            $this->question = $this->findQuestion($questionId, $this->items);
        } else {
            $this->question = null;
        }

        parent::display($template);
    }

    private function findQuestion($questionId, $questions) {
        foreach ($questions as $question) {
            if ($question->id == $questionId) {
                return $question;
            }
        }
        return null;
    }

}