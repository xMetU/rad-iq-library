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
$document->addScript("media/com_myquiz/js/quizView.js");
$document->addStyleSheet("media/com_myquiz/css/style.css");

?>

<!-- Header -->
<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current(); ?>">Back</a>
	</div>
	<div class="col-8 text-center">
		<h3><?php echo $this->quiz->title; ?></h3>
	</div>
	<div class="col">
        <a class="btn float-end navigator" href="<?php echo
            Uri::getInstance()->current()
            . '?task=Form.submitUserAnswers';
        ?>">Finish</a>
    </div>
</div>

<hr/>

<!-- Previous Button | Questions | Next Button -->
<div class="row ">
    <div class="col">
        <?php if ($this->question->number > 0): ?>
            <a class="btn float-end navigator" href="<?php echo
                Uri::getInstance()->current()
                . '?task=Quiz.navigateToQuestion&quizId=' . $this->quiz->id
                . '&questionId=' . $this->questions[$this->question->number - 1]->id;
            ?>">Previous</a>
        <?php else: ?>
            <button class="btn float-end" disabled>Previous</button>
        <?php endif; ?>
    </div>

    <div class="col-auto text-center">
        <?php foreach ($this->questions as $i => $row): ?>
            <?php if ($row->number != $this->question->number): ?>
                <a class="btn navigator" href="<?php echo
                    Uri::getInstance()->current()
                    . '?task=Quiz.navigateToQuestion&quizId=' . $this->quiz->id
                    . '&questionId=' . $this->questions[$row->number]->id;
                ?>"><?php echo $row->number + 1; ?></a>
            <?php else: ?>
                <button class="btn" disabled><?php echo $row->number + 1; ?></button>
            <?php endif; ?>
            
        <?php endforeach; ?>
    </div>

    <div class="col">
        <?php if ($this->question->number < count($this->questions)-1): ?>
            <a class="btn navigator" href="<?php echo
                Uri::getInstance()->current()
                . '?task=Quiz.navigateToQuestion&quizId=' . $this->quiz->id
                . '&questionId=' . $this->questions[$this->question->number + 1]->id;
            ?>">Next</a>
        <?php else: ?>
            <button class="btn" disabled>Next</button>
        <?php endif; ?>
    </div>
</div>

<hr/>

<!-- Question and Answers -->
<div class="row">
    <div class="col">
        <img src="<?php echo $this->quiz->imageUrl; ?>" />
    </div>
    <div class="col">
        <form
            action=""
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
            <input type="hidden" name="questionId" value="<?php echo $this->question->id; ?>"/>
            
            <h5 id="<?php echo $this->question->id; ?>"><?php echo $this->question->number + 1 . '. ' . $this->question->description; ?></h5>

            <?php foreach ($this->answers as $row) : ?>
                <div class="row mt-3">
                    <div class="col-auto">
                        <input type="radio" name="answerId" value="<?php echo $row->id; ?>"/>
                    </div>
                    <div class="col"><?php echo $row->description; ?></div>
                </div>
            <?php endforeach; ?>
        </form>
    </div>    
</div>