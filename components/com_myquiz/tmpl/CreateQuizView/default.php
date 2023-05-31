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

<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current(); ?>">Back</a>
	</div>
	<div class="col-8 text-center">
        <h3><?php echo ($this->quiz ? "Edit " . $this->quiz->title : "Create New Quiz"); ?></h3>
	</div>
	<div class="col">
        <?php if ($this->quiz): ?>
            <a
                class="btn float-end"
                href="<?php echo Uri::getInstance()->current() . '?task=Display.questionForm&quizId=' . $this->quiz->id; ?>"
            >Questions</a>
        <?php endif; ?>
    </div>
</div>

<hr/>

<div class="row justify-content-center">
    <div class="col-8">
        <form 
            action="<?php echo Uri::getInstance()->current() . ($this->quiz ? '?task=Form.updateQuiz' : '?task=Form.saveQuiz'); ?>"
            method="post"
            id="adminForm"
            name="adminForm"
            enctype="multipart/form-data"
        >
            <?php if ($this->quiz) : ?>
				<input type="hidden" name="id" value="<?php echo $this->quiz->id; ?>"/>
			<?php endif; ?>

            <div class="form-group">
                <label for="title">Title: *</label>

                <input 
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="Enter title..."
                    maxlength="60"
                    required
                    value="<?php echo $this->quiz ? $this->quiz->title : ""; ?>"
                />
            </div>

            <hr/>

            <div class="row">
                <div class="col form-group">
                    <label for="imageId">Image: *</label>
                    <select name="imageId"  placeholder="Select quiz image..." class="form-control form-select">
                        <option value="" <?php if (!$this->quiz) echo "selected"; ?>disabled hidden>Select a category</option>
                        <?php foreach ($this->images as $row) : ?>
                            <option
                                value="<?php echo $row->id; ?>"
                                <?php if ($this->quiz && $row->id == $this->quiz->imageId) echo "selected"; ?>
                            ><?php echo $row->imageName; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col form-group">
                    <label for="attemptsAllowed">Attempts Allowed: *</label>

                    <input
                        type="number"
                        name="attemptsAllowed"
                        class="form-control"
                        placeholder="Number of attempts allowed..."
                        required
                        min="1"
                        value="<?php echo $this->quiz ? $this->quiz->attemptsAllowed : ""; ?>"
                    />
                </div>
            </div>

            <hr/>

            <div class="form-group">
                <label for="description">Description: *</label>

                <textarea
                    name="description"
                    class="form-control"
                    placeholder="Enter description..."
                    maxlength="200"
                    required
                    rows="4"
                ><?php echo $this->quiz ? $this->quiz->description : ""; ?></textarea>
            </div>

            <hr/>

            <div class="form-group">
				<button class="btn">
					<i class="icon-check"></i> Done
				</button>
			</div>
        </form>
    </div>
</div>
