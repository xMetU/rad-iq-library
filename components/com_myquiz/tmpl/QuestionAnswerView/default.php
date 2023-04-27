<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 *
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;


foreach ($this->items as $i => $row){
    $question = $row->questionDescription;
}
?>


<!-- ====== Display Single Quiz =========== -->

<div class="mt-5">

    <div><h3><?php echo $question; ?></h3></div>

    <div class="mt-5 mb-5">
        <?php foreach ($this->items as $i => $row) : ?>
            <div class="row mt-3">
                <div class="col-1">
                    <input type="radio" name="correct" value="$row->answerNumber"/>
                </div>
                <div class="col-1"><?php echo $row->answerNumber . '.' ?></div>
                <div class="col-10"><?php echo $row->answerDescription ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    

    <div class="row mt-5">
        <div class="col-1">   
            <button class="btn btn-primary" onclick="Joomla.submitbutton(Form.saveAnswer)"><?php echo Text::_(' PREV'); ?></button>
        </div>
        <div class="col-1">   
            <button class="btn btn-primary" onclick="Joomla.submitbutton(Form.saveAnswer)"><?php echo Text::_(' NEXT'); ?></button>
        </div>                      
    </div>
            
</div>

