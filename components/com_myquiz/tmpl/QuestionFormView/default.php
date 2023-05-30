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

<!-- ====== CREATE QUESTION DISPLAY =========== -->

<div class="row">
	<div class="col">
		<a 
            class="btn"
            href="<?php echo Uri::getInstance()->current() . '?task=Display.questionManager&id=' . $this->quizId; ?>"
        >Back</a>
	</div>
	<div class="col-8 text-center">
		<h3><?php echo $this->question ? "Edit Question: " . $this->question->questionDescription : "Create Question"; ?></h3>
	</div>
	<div class="col"></div>
</div>

<hr/>

<div class="row justify-content-center">
    <div class="col-8">
        <form 
            action="<?php echo Uri::getInstance()->current() . ($this->question ? '?task=Form.updateQuestion' : '?task=Form.saveQuestion'); ?>"
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
            <input type="hidden" name="quizId" value="<?php echo $this->quizId; ?>"/>
            <?php if ($this->question): ?>
                <input type="hidden" name="questionNumber" value="<?php echo $this->question->questionNumber; ?>"/>
            <?php endif; ?>

            <div class="form-group">
                <label for="questionDescription">Question: *</label>

                <textarea
                    name="questionDescription"
                    class="form-control"
                    placeholder="What is the question?"
                    maxlength="200"
                    required
                    rows="2"
                ><?php echo $this->question ? $this->question->questionDescription : ""; ?></textarea>
            </div>

            <hr/>

            <div class="form-group">
                <label for="feedback">Feedback: *</label>

                <textarea
                    name="feedback"
                    class="form-control"
                    placeholder="Feedback when the question is answered."
                    maxlength="200"
                    required
                    rows="2"
                ><?php echo $this->question ? $this->question->feedback : ""; ?></textarea>
            </div>

            <hr/>

            <div class="form-group">
                <label data-toggle="tooltip" for="markValue">Marks: *</label>

                <input
                    type="number"
                    name="markValue"
                    class="form-control"
                    placeholder="How many marks is this question worth?"
                    min="1"
                    value="<?php echo $this->question ? $this->question->markValue : ""; ?>"
                />
            </div>

            <hr/>

            <div class="form-group">
                <button class="btn"><i class="icon-check"></i> Done</button>
            </div>
        </form>

        <?php // TODO: ANSWERS FORM HERE ?>

        <form 
            action="<?php echo Uri::getInstance()->current() . '?task=CreateQuiz.processAnswers' ?>"
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
        </form>
    </div>
</div>
