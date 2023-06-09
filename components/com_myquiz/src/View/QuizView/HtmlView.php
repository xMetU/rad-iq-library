<?php

namespace Kieran\Component\MyQuiz\Site\View\QuizView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class HtmlView extends BaseHtmlView {
    
    public function display($template = null) {
        $this->quiz = $this->get('Item', 'Quiz');
        $this->questions = $this->get('Items', 'Questions');
        $this->answers = $this->get('Items', 'Answers');

        $this->question = null;
        foreach ($this->questions as $i => $question) {
            $question->number = $i;
            if ($question->id == Factory::getApplication()->input->getVar('questionId')) {
                $this->question = $this->questions[$i];
            }
        }

        $correctAnswerCount = 0;
        foreach ($this->answers as $answer) {
            if ($answer->markValue > 0) {
                $correctAnswerCount++;
            }
        }
        $this->isRadio = $correctAnswerCount == 1;

        $userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        if ($this->question && $userAnswers && array_key_exists($this->question->id, $userAnswers)) {
            $this->userAnswers = $userAnswers[$this->question->id];
        } else {
            $this->userAnswers = null;
        }
        
        parent::display($template);
    }

}