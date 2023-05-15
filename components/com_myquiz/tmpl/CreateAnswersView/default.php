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

?>


<!-- ====== CREATE ANSWERS DISPLAY =========== -->

<div>
    <h3><?php echo 'Question: ' . $this->questionDescription; ?></h3>
</div>

<div class="mt-5">
    <div><?php echo 'Answers: '; ?></div>
    <?php if ($this->answerArray) : ?>
        <?php foreach ($this->answerArray as $row) : ?>
            <?php if ($row['questionNumber'] == $this->questionNumber) : ?>
                <div class="row">
                    <div class="col-1"><?php echo $row['answerNumber'] . ': '; ?></div>
                    <div class="col-3"><?php echo $row['answerDescription']; ?></div>
                </div>   
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="mt-5">
    <div class="col-3"><h3><?php echo 'New Answer: '; ?></h3></div>
</div>

<div class="mt-2">
    <form 
        action="<?php echo Uri::getInstance()->current() . '?&task=CreateQuiz.processAnswers' ?>"
        method="post"
        id="adminForm"
        name="adminForm"
        enctype="multipart/form-data"
    >

        <!-- Description -->
        <div class="form-group mt-5">
            <label for="answerDescription">Describe Answer:</label>
            <input type="text" name="answerDescription" placeholder="An answer to the question" class="form-control"/>
        </div>

        <div class="form-group mt-5">
            <input type="checkbox" name="isCorrect" value="1"/>
            <label for="isCorrect">: Is this the correct answer?</label>
        </div>


        <div class="form-group mt-5">
            <input type="hidden" name="questionNumber" value="<?php echo $this->questionNumber; ?>" class="form-control"/>
            <input type="hidden" name="answerNumber" value="<?php echo $this->answerNumber; ?>" class="form-control"/>
        </div>

        <div class="row">
            <div class="col-4 form-group">
                <button class="btn btn-success" id="createQuiz-submit" onclick="Joomla.submitbutton(CreateQuiz.processAnswers)"><?php echo Text::_("SAVE ANSWER")?></button>
            </div>
            <div class="col-4 form-group">
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&questionNumber=' . $this->questionNumber . '&task=Display.createQuestions') ?>"><?php echo Text::_("NEW QUESTION")?></a>
            </div>
            <div class="col-4 form-group">
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=CreateQuiz.saveAllQuiz') ?>"><?php echo Text::_("FINISH AND SAVE QUIZ")?></a>
            </div>
        </div>
    </form>

</div>

