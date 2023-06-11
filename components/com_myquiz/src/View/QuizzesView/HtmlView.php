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
        $this->userId = Factory::getUser()->id;
        $this->items = $this->get('Items');
        if ($this->userId) {
            foreach ($this->items as $item) {
                $userAttempts = $this->getModel('UserAnswers')->getAttemptCount($this->userId, $item->id);
                $item->attemptsRemaining = $item->attemptsAllowed - $userAttempts;
            }
        }
        $this->allQuizzes = $this->get('AllQuizzes');
        $this->getModel('UserAnswers')->getAttemptCount($this->userId, 1);
        $this->categories = $this->get('Items', 'Categories');
        $this->subcategories = $this->get('Items', 'SubCategories');
        $this->pagination = $this->get('Pagination');
        $this->category = Factory::getApplication()->getUserState('myImageViewer_myQuiz.category');
        $this->subcategory = Factory::getApplication()->input->getVar('subcategory');
        $this->search = Factory::getApplication()->input->get('search');

        parent::display($template);
    }

}