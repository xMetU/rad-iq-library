<?php

namespace Kieran\Component\MyImageViewer\Site\View\CategoryFormView;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 *
 */

class HtmlView extends BaseHtmlView {


    public function display($template = null) {
        
        
        $this->categoryId = Factory::getApplication()->input->getInt('categoryId');
        $this->subcategoryId = Factory::getApplication()->input->getInt('subcategoryId');

        Factory::getApplication()->setUserState('myImageViewer.categoryId', $this->categoryId);

        $this->categories = $this->get('Items', 'Categories');
        $this->toQuiz = Factory::getApplication()->getUserState('myImageViewer_myQuiz.view') == "QUIZZES";
        $this->subcategories = $this->get('CategorySubcategories', 'SubCategories');

        

        // Call the parent display to display the layout file
        parent::display($template);
    }

}