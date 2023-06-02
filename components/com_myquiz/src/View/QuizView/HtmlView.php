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
        $this->userAnswers = Factory::getApplication()->getUserState('myQuiz.userAnswers');
        var_dump($this->userAnswers);

        foreach ($this->questions as $i => $question) {
            $question->number = $i;
            if ($question->id == Factory::getApplication()->input->getVar('questionId')) {
                $this->question = $this->questions[$i];
            }
        }
        
        parent::display($template);
    }

}