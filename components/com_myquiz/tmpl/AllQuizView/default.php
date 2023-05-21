<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Kieran\Component\MyQuiz\Site\Helper\CheckGroup;

$document = Factory::getDocument();
$document->addStyleSheet("media/com_myquiz/css/style.css");
?>


<!-- ====== Display all Quizzes =========== -->


<!-- Create Quiz Button -->
<div>
    <!-- User Check to see if they belong to Manager user group. Only managers should access this function -->
    <?php if (CheckGroup::isGroup("Manager")) : ?>
        <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=Display.createQuiz') ?>"><i class="icon-plus icon-white"></i><?php echo ' CREATE QUIZ' ?></a>
    <?php endif; ?>
</div>


<div class="row mt-5" id="categoryParent">
    
    <div class="col-3" id="categoryScroll">
        <?php foreach ($this->categories as $c => $row) : ?>
            <div class="row mt-3 col-5">		
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&categoryId=' . $row->id) ?>"><?php echo $row->categoryName ?></a>						
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ==== QUIZ LIST ==== -->
    <div class="col-9">
        <?php foreach ($this->items as $i => $row) : ?>
            <?php if ($row->isHidden == 0) : ?>
                <div class="row mt-3 bg-light">
                    <div class="col-3">								
                        <img id="<?php echo $row->imageId; ?>" src="<?php echo $row->imageUrl; ?>" style="width:150px;height:180px;"/>
                    </div>

                    <div class="col-9">
                        <div class="row mt-2">
                            <div class="col-2 text-center"><?php echo Text::_("Title: ") ?></div>
                            <div class="col-6"><?php echo $row->title; ?></div>
                            
                            <div class="col-3">
                                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . 
                                                Route::_('?&id='. $row->id . '&question=1&attemptsAllowed=' . $row->attemptsAllowed . 
                                                '&task=Answer.startQuiz') ?>"><?php echo Text::_("START QUIZ")?></a>
                            </div>
                            
                            <div class="col-1">
                                <!-- User Check to see if they belong to Manager user group. Only managers should access this function -->
                                <?php if (CheckGroup::isGroup("Manager")) : ?>
                                    <button id="delete-button" name="delete-button" class="btn btn-danger">
                                            <i class="icon-times icon-white"></i>
                                    </button> 
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-2 text-center"><?php echo Text::_("Description: ") ?></div>
                            <div class="col-6"><?php echo $row->description; ?></div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-2 text-center"><?php echo Text::_("Attempts: ") ?></div>
                            <div class="col-6"><?php echo $row->attemptsAllowed; ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    
        <div>
            <div><?php echo $this->pagination->getListFooter(); ?></div>
        </div>

    </div>

    <!-- Delete confirmation -->
    <div id="delete-confirmation" class="overlay-background d-flex d-none">
        <div class="m-auto justify-content-center">
            <div class="row mb-4 text-center">
                <h3>WARNING!</h3>
                <h4>You are about to remove this quiz</h4>
                <p>All users will lose their scores. This cannot be undone. 
                    Are you sure you want to continue?</p>
            </div>
            <div class="row">
                <div class="col">
                    <button id="delete-confirm" class="delete-yes btn float-end me-3">YES</button>
                </div>
                <div class="col">
                    <button id="delete-cancel" class="btn ms-3">NO</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    const deleteConfirmation = document.getElementById("delete-confirmation");
    let buttons = Array.from(document.getElementsByName("delete-button"));

    buttons.forEach(button => {
        button.onclick = (e) => {
            deleteConfirmation.classList.remove("d-none");
        }
    });
    

    document.getElementById("delete-confirm").onclick = () => {
        window.location.href = "<?php echo Uri::getInstance()->current() . 
                                    Route::_('?&quizId='. $row->id . '&task=Display.deleteQuiz') ?>";
        deleteConfirmation.classList.add("d-none");
    }

    document.getElementById("delete-cancel").onclick = (e) => {
        deleteConfirmation.classList.add("d-none");
    }
</script>



