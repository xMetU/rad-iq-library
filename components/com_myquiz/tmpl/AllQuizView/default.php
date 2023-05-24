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

$document = Factory::getDocument();
$document->addScript("media/com_myquiz/js/allQuizView.js");
$document->addStyleSheet("media/com_myquiz/css/style.css");

?>


<!-- ====== Display all Quizzes =========== -->
<!-- Headers -->
<div class="row">
	<div class="col-2 text-center my-auto">
		<h6>Categories</h6>
	</div>
	<div class="col-10 row ps-5">
		<div class="col">
			<a class="btn" href="<?php echo Uri::getInstance()->current() . '?task=Display.categoryForm'; ?>">Manage</a>
		</div>
		<div class="col text-center">
			<h3>Quizzes</h3>
		</div>
		<div class="col">
			<a class="btn float-end" href="<?php echo Uri::getInstance()->current() . '?task=Display.createQuiz'; ?>">
				<i class="icon-plus icon-white"></i> New
			</a>
		</div>
	</div>
</div>

<div class="row">
    <!-- Categories -->
    <div class="col-2">
		<table id="categories" class="w-100">
			<tbody>
				<?php if (!empty($this->categories)) : ?>
					<?php foreach ($this->categories as $row) : ?>
						<tr>
							<td class="pt-3 overflow-hidden">
								<a
									class="btn w-100 py-1 text-center<?php echo $row->id == $this->category ? " active" : ""; ?>"
									href="<?php echo Uri::getInstance()->current()
										. ($row->id == $this->category ? "" : '?category='. $row->id);
									?>"
								>
									<?php echo $row->categoryName; ?>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

    <!-- Quizzes -->
    <div class="col-10 row ps-5">
        <table id="quizzes" class="table table-borderless">
            <tfoot>
                <tr>
                    <td class="d-flex justify-content-center p-2">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>

            <tbody>
                <?php if (!empty($this->items)) : ?>
					<tr class="row">
						<?php foreach ($this->items as $item) : ?>
							<td class="col-12 pt-3 px-3">
								<div class="card p-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <img
                                                id="<?php echo $item->imageId; ?>"
                                                class="card-img-top"
                                                src="<?php echo $item->imageUrl; ?>"
                                            />
                                        </div>
                                        <div class="col">
                                            <div class="card-body p-0">
										        <h5 class="text-truncate"><?php echo $item->title; ?></h5>
                                                <p><?php echo $item->description; ?></p>
                                                <a 
                                                    class="btn"
                                                    href="<?php
                                                        echo Uri::getInstance()->current() . '?task=Answer.startQuiz&id=' . $item->id
                                                        . '&question=1&attemptsAllowed=' . $item->attemptsAllowed;
                                                    ?>"
                                                >Attempt Quiz</a>
									        </div>
                                        </div>
										<div class="col-auto">
											<button id="<?php echo $item->id; ?>" class="delete-button btn">Delete</button> 
										</div>
                                    </div>	
								</div>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php else: ?>
					<tr>
						<td>
							<p class="text-secondary text-center pt-5">No quizzes are assigned to this category</p>
						</td>
					</tr>
				<?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete confirmation -->
<div id="delete-confirmation" class="d-none">
    <form
        action="<?php echo Uri::getInstance()->current() . '?task=Display.deleteQuiz'; ?>"
        method="post"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="quizId"/>

        <div class="overlay-background d-flex">
            <div class="m-auto text-center">
                <h5 class="mb-4"><!-- Message --></h5>
                <button id="delete-confirm" class="btn me-3">Yes, remove it</button>
                <button id="delete-cancel" class="btn ms-3">No, go back</button> 
            </div>
        </div>
    </form>
</div>
