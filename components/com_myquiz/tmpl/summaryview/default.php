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
$document->addScript("media/com_myquiz/js/summaryView.js");
$document->addStyleSheet("media/com_myquiz/css/style.css");

?>

<!-- SUMMARY VIEW -->

<!-- Header -->
<div class="row">
	<div class="col">
        <a class="btn" href="<?php echo Uri::getInstance()->current() ?>">Back</a>
	</div>
	<div class="col-8 text-center">
		<h3>Quiz Summary</h3>
	</div>
	<div class="col">
        <a 
            class="btn float-end"
            href="<?php echo Uri::getInstance()->current() . '?task=Display.scores'; ?>"
        >View All Scores</a>
    </div>
</div>

<hr />

<div class="row justify-content-center">
    <div id="questions" class="col-8">
        <h4 class="text-end">Score: <?php echo $this->marks . ' / ' . $this->total; ?></h4>
        <?php foreach ($this->items as $i => $row): ?>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title"><?php echo $i + 1 . ": " . $row->questionDescription; ?></h5>

                            <p>You answered: <?php echo $row->answerDescription; ?></p>
                            <p>
                            <?php if ($row->isCorrect): ?>
                                <i id="correct" class="icon-checkmark-circle"></i> Correct
                            <?php else : ?>
                                <i id="incorrect" class="icon-cancel-circle"></i> Incorrect
                            <?php endif ?>
                            </p>
                            <p class="card-text"><?php echo $row->feedback; ?></p>
                        </div>   

                        <div class="col-auto">
                            <?php if ($row->isCorrect): ?>
                                <h5><?php echo "Marks: " . $row->markValue . ' / ' . $row->markValue; ?></h5>
                            <?php else : ?> 
                                <h5><?php echo "Marks: 0" . ' / ' . $row->markValue; ?></h5>
                            <?php endif ?>                                            
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
