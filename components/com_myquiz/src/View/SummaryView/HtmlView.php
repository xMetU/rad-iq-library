<?php

namespace Kieran\Component\MyQuiz\Site\View\SummaryView;

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

        $items = $this->get('Items');
        var_dump($items);
        
        // TODO: consolidate into question => answer[] pairs
        $this->items = [];
        foreach ($items as $item) {
            
        }

        parent::display($template);

    }

}