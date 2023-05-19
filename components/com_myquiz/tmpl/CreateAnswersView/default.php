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
            class="btn float-start"
            href="<?php echo Uri::getInstance()->current() . '?task=Display.createQuestions&questionNumber=' . $this->questionNumber; ?>"
        >Add Another Question</a>
	</div>
	<div class="col-8 text-center">
		<h3>Add Answers to <?php echo $this->questionDescription; ?></h3>
	</div>
	<div class="col">
        <a 
            class="btn float-end"
            href="<?php echo Uri::getInstance()->current() . '?task=CreateQuiz.saveAllQuiz'; ?>"
        >Finish and Save Quiz</a>
    </div>
</div>

<hr/>

<!-- TODO: Make this table look prettier -->
<div class="row justify-content-center">
    <div class="col-8">
        <?php if ($this->answerArray) : ?>
            <table class="w-100">
                <thead class="border-bottom">
                    <th class="col-1">#</th>
                    <th class="col-2">Correct</th>
                    <th class="col">Answer</th>
                </thead>
                <?php foreach ($this->answerArray as $row) : ?>
                    <?php if ($row['questionNumber'] == $this->questionNumber) : ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['answerNumber']; ?>.</td>
                                <td><i class="<?php if ($row['isCorrect']) echo " icon-checkmark-circle"; ?>"></i></td>
                                <td><?php echo $row['answerDescription']; ?></td>
                            </tr>
                        </tbody>                   
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
            <hr/>
        <?php endif; ?>
        

        <form 
            action="<?php echo Uri::getInstance()->current() . '?task=CreateQuiz.processAnswers' ?>"
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
            <input type="hidden" name="questionNumber" value="<?php echo $this->questionNumber; ?>"/>
            <input type="hidden" name="answerNumber" value="<?php echo $this->answerNumber; ?>"/>

            <div class="row form-group">
                <div class="col">
                    <label for="answerDescription">New Answer: *</label>

                    <input 
                        type="text"
                        name="answerDescription"
                        class="form-control"
                        placeholder="Enter answer text..."
                    />
                </div>

                <div class="col-auto">
                    <button class="btn mt-4" id="createQuiz-submit" onclick="Joomla.submitbutton(CreateQuiz.processAnswers)">Add</button>
                </div>
            </div>

            <div class="form-group">
                <input type="checkbox" name="isCorrect" value="1"/>
                <label for="isCorrect">Is this a correct answer?</label>
            </div>
        </form>
    </div>
</div>
