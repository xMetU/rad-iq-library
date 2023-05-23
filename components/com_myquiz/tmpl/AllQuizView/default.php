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
    
    <div class="col-2" id="categoryScroll">
        <?php foreach ($this->categories as $c => $row) : ?>
            <div class="row mt-3 col-10">		
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&categoryId=' . $row->id) ?>"><?php echo $row->categoryName ?></a>						
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ==== QUIZ LIST ==== -->
    <div class="col-10">
        <form action="<?php echo Uri::getInstance()->current() . '?&task=Display.hideQuiz' ?>"
                method="post"
                id="adminForm"
                name="adminForm"
                enctype="multipart/form-data" >
            <?php foreach ($this->items as $i => $row) : ?>
                
                <!-- Render all quizzes including hidden for managers, with manager functions -->
                <?php if (CheckGroup::isGroup("Manager")) : ?>
                    <?php $render = true; ?>

                <!-- Only render quizzes that aren't hidden for non-managers -->    
                <?php elseif ($row->isHidden == 0) : ?>
                    <?php $render = true; ?>
                
                <!-- Quiz is hidden and shouldn't be viewed --> 
                <?php else : ?>
                    <?php $render = false; ?>
                <?php endif; ?>
            <?php endforeach; ?>
    
            <!-- Only show allowed elements -->
            <?php if ($render) : ?>
                <div class="row mt-3 bg-light">

                    <!-- IMAGE -->
                    <div class="col">								
                        <img id="<?php echo $row->imageId; ?>" src="<?php echo $row->imageUrl; ?>" style="width:150px;height:180px;"/>
                    </div>

                    <!-- TEXT -->
                    <div class="col-5 mt-4">
                        <div class="row mt-2">
                            <div class="col-3 text-center"><?php echo Text::_("Title: ") ?></div>
                            <div class="col-9"><?php echo $row->title; ?></div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-3 text-center"><?php echo Text::_("Description: ") ?></div>
                            <div class="col-9"><?php echo $row->description; ?></div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-3 text-center"><?php echo Text::_("Attempts: ") ?></div>
                            <div class="col-9"><?php echo $row->attemptsAllowed; ?></div>
                        </div>
                    </div>

                    <!-- START QUIZ -->
                    <div class="col mt-4">
                        <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . 
                                    Route::_('?&id='. $row->id . '&question=1&attemptsAllowed=' . $row->attemptsAllowed . 
                                            '&task=Answer.startQuiz') ?>"><?php echo Text::_("START QUIZ")?></a>
                    </div>

                    <!-- MANAGER BUTTONS -->
                    <!-- User Check to see if they belong to Manager user group. Only managers should access these functions -->
                    <?php if (CheckGroup::isGroup("Manager")) : ?>

                        <!-- HIDE QUIZ -->
                        <div class="col mt-4">
                                
                            <label for="hideQuiz"><u><?php echo Text::_("Hide/Unhide Quiz") ?></u></label>
                            <div class="row">
                                <div class="col-2">
                                    <input type="checkbox" id="hide" name="hide" value="<?php echo $row->id; ?>"/>
                                </div>
                                <?php if ($row->isHidden == 1) : ?>
                                    <div class="col-1"><i class="icon-delete"></i></div>
                                    <div class="col"><?php echo Text::_("Hidden") ?></div>
                                <?php else : ?>
                                    <div class="col-1"><i class="icon-checkmark-circle"></i></div>
                                    <div class="col"><?php echo Text::_("Visible") ?></div>
                                <?php endif; ?>  
                            </div>                                
                        </div>
                                
                        <!-- DELETE QUIZ -->
                        <div class="col mt-4">
                            <label for="deleteQuiz"><u><?php echo Text::_("Delete Quiz") ?></u></label>
                            <div class="row">
                                <div class="col-1"></div>
                                <button id="delete-button" name="delete-button" class="btn btn-danger col-4">
                                    <i class="icon-times icon-white"></i>
                                </button>
                            </div>   
                        </div>                   
                    <?php endif; ?>

                    
                </div>
            <?php endif; ?>  
        </form> 

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
    const hide = Array.from(document.getElementsByName("hide"));

    hide.forEach(box => {
        box.onclick = () => {
            let form = document.getElementById("adminForm");
            form.submit();  
        }
    });
    

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



