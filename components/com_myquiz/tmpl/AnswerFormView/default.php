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

$document = Factory::getDocument();
$document->addStyleSheet("media/com_myquiz/css/style.css");

?>

<!-- ====== CREATE ANSWERS DISPLAY =========== -->

<div class="row">
	<div class="col">
		<a 
            class="btn"
            href="<?php echo 
                Uri::getInstance()->current()
                . '?task=Display.questionForm&quizId=' . $this->question->quizId
                . '&questionId=' . $this->question->id; ?>"
        >Back</a>
	</div>
	<div class="col-8 text-center text-truncate">
		<h3>Answers: "<?php echo $this->question->description; ?>"</h3>
	</div>
	<div class="col"></div>
</div>

<hr/>

<!-- TODO: Make this table look prettier -->
<div class="row">
    <div class="col ps-5">
        <form 
            action="<?php echo Uri::getInstance()->current() . '?task=CreateQuiz.processAnswers' ?>"
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
            <input type="hidden" name="questionNumber" value="<?php echo $this->questionNumber; ?>"/>
            <input type="hidden" name="answerNumber" value="<?php echo $this->answerNumber; ?>"/>

            <div class="form-group">
                <label for="answerDescription">New Answer: *</label>

                <textarea 
                    type="text"
                    name="answerDescription"
                    class="form-control"
                    placeholder="Enter answer text..."
                    maxlength="200"
                    required
                    rows="2"
                ></textarea>
            </div>

            <div class="row form-group">
                <div class="col">
                    <input type="checkbox" name="isCorrect" value="1"/>
                    <label for="isCorrect">Is this the correct answer?</label>
                </div>
            
                <div class="col-auto">
                    <button class="btn" id="createQuiz-submit" onclick="Joomla.submitbutton(CreateQuiz.processAnswers)">Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col">
        <div id="answers">
            <?php foreach ($this->items as $row) : ?>
                <div class="row p-2 mb-3">
                    <div class="col-1"><i class="<?php echo $row->isCorrect ? " icon-check" : " icon-times"; ?>"></i></div>
                    <div class="col text-truncate"><?php echo $row->description; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
