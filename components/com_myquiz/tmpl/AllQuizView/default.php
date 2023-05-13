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

?>


<!-- ====== Display all Quizzes =========== -->


<!-- Create Quiz Button -->
<div>
    <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=Display.createQuiz') ?>"><?php echo 'CREATE QUIZ' ?></a>
</div>


<div class="row mt-5">

    <div class="col-3">
        <?php foreach ($this->categories as $c => $row) : ?>
            <div class="row mt-3 col-5">		
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&categoryId=' . $row->id) ?>"><?php echo $row->categoryName ?></a>						
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ==== QUIZ LIST ==== -->
    <div class="col-9">
        <?php foreach ($this->items as $i => $row) : ?>
            <div class="row mt-3 bg-light">
                <div class="col-3">								
                    <img id="<?php echo $row->imageId; ?>" src="<?php echo $row->imageUrl; ?>" style="width:150px;height:180px;"/>
                </div>
                <div class="col-9">
                    <div class="row mt-2">
                        <div class="col-3 text-center"><?php echo Text::_("Title: ") ?></div>
                        <div class="col-6"><?php echo $row->title; ?></div>
                        <div class="col-3">
                            <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . 
                                                Route::_('?&id='. $row->id . '&question=1&attemptsAllowed=' . $row->attemptsAllowed . 
                                                '&task=Answer.startQuiz') ?>"><?php echo Text::_("START QUIZ")?></a></div>
                        </div>

                    <div class="row mt-2">
                        <div class="col-3 text-center"><?php echo Text::_("Description: ") ?></div>
                        <div class="col-6"><?php echo $row->description; ?></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-3 text-center"><?php echo Text::_("Attempts: ") ?></div>
                        <div class="col-6"><?php echo $row->attemptsAllowed; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    
        <div>
            <div><?php echo $this->pagination->getListFooter(); ?></div>
        </div>

    </div>


</div>

