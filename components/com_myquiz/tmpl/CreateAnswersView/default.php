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



$quizId = Factory::getApplication()->getUserState('myQuiz.quizId');
$questionDescription = Factory::getApplication()->getUserState('myQuiz.questionDescription');
$answerNumber = Factory::getApplication()->input->get('answerNumber') + 1;
$questionNumber = Factory::getApplication()->input->get('questionNumber');
?>


<!-- ====== CREATE ANSWERS DISPLAY =========== -->

<div>
    <h3><?php echo 'Question: ' . $questionDescription; ?></h3>
</div>

<div class="mt-5">
    <h3><?php echo 'Answer: '; ?></h3>
</div>

<div class="mt-5">
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
            <input type="hidden" name="questionNumber" value="<?php echo $questionNumber; ?>" class="form-control"/>
            <input type="hidden" name="answerNumber" value="<?php echo $answerNumber; ?>" class="form-control"/>
        </div>

        <div class="row">
            <div class="col-4 form-group">
                <button class="btn btn-success" id="createQuiz-submit" onclick="Joomla.submitbutton(CreateQuiz.processAnswers)"><?php echo Text::_("SAVE ANSWER")?></button>
            </div>
            <div class="col-4 form-group">
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&questionNumber=' . $questionNumber . '&task=Display.createQuestions') ?>"><?php echo Text::_("NEW QUESTION")?></a>
            </div>
            <div class="col-4 form-group">
                <a class="btn btn-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=CreateQuiz.saveAllQuiz') ?>"><?php echo Text::_("FINISH AND SAVE QUIZ")?></a>
            </div>
        </div>
    </form>

</div>

