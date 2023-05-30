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

<!-- Header -->
<div class="row">
	<div class="col">
		<a 
			class="btn"
			href="<?php echo Uri::getInstance()->current() . '?task=Display.createQuiz&id=' . $this->quiz->id; ?>"
		>Back</a>
	</div>
	<div class="col-8 text-center">
		<h3>Questions: <?php echo $this->quiz->title; ?></h3>
	</div>
	<div class="col">
		<a
			class="btn float-end"
			href="<?php echo Uri::getInstance()->current() . '?task=Display.questionForm&quizId=' . $this->quiz->id; ?>"
		><i class="icon-plus"></i> New Question</a>
    </div>
</div>

<hr/>

<div class="row justify-content-center">
    <div id="questions" class="col-8">
        <?php foreach ($this->items as $i => $row) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title"><?php echo "Question " . $i+1 . ": " . $row->questionDescription; ?></h5>
						</div>
						<div class="col-auto d-flex flex-column">
							<a 
								class="btn"
								href="<?php echo Uri::getInstance()->current() . '?task=Display.createQuestion&id=' . $row->id; ?>"
							>Edit</a>
							<button id="<?php echo $row->id; ?>" class="delete-button btn mt-2"><i class="icon-delete"></i> Delete</button> 
						</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
