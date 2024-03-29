<?php

namespace Kieran\Component\MyQuiz\Site\View\QuizzesView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Kieran\Component\MyImageViewer\Site\Helper\CheckGroup;

/**
 * @package     Joomla.Site
 * @subpackage  com_myQuiz
 */

class HtmlView extends BaseHtmlView {
    
    public function display($template = null) {
        $this->userId = Factory::getUser()->id;

        $this->items = $this->get('Items');
        if ($this->userId) {
            if($this->items) {
                foreach ($this->items as $item) {
                    $userAttempts = $this->getModel('UserAnswers')->getAttemptCount($this->userId, $item->id);
                    $item->attemptsRemaining = $item->attemptsAllowed - $userAttempts;
                }
            }        
        }
        else {
            Factory::getApplication()->enqueueMessage('Please login.');
            Factory::getApplication()->redirect(Route::_(Uri::root() . 'index.php?&option=com_myfrontpage&view=myfrontpage', false));
        }

        $allQuizzes = $this->get('AllQuizzes');
        $this->categories = $this->get('Items', 'Categories');

        if($this->categories){
            foreach ($this->categories as $category) {
                $category->count = 0;
                foreach ($allQuizzes as $quiz) {
                    if ($quiz->categoryId == $category->categoryId) {
                        if($quiz->isHidden){
                            if (CheckGroup::isGroup("Manager")){
                                $category->count++;
                            }
                        }
                        else{
                            $category->count++;
                        }
                    }
                }
            }
        }
        
        $this->subcategories = $this->get('Items', 'SubCategories');

        if($this->subcategories){
            foreach ($this->subcategories as $subcategory) {
                $subcategory->count = 0;
                foreach ($allQuizzes as $quiz) {
                    if ($quiz->subcategoryId == $subcategory->subcategoryId) {
                        if($quiz->isHidden){
                            if (CheckGroup::isGroup("Manager")){
                                $subcategory->count++;
                            }
                        }
                        else{
                            $subcategory->count++;
                        }
                    }
                }
            }
        }
        

        $this->pagination = $this->get('Pagination');
        $this->category = Factory::getApplication()->getUserState('myImageViewer_myQuiz.category');
        $this->subcategory = Factory::getApplication()->getUserState('myImageViewer_myQuiz.subcategory');
        $this->search = Factory::getApplication()->input->get('search');

        parent::display($template);
    }

}