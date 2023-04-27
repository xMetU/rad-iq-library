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

?>

<!-- ====== Display Single Quiz =========== -->

<div class="mt-5">
    <table>
        <tbody>
            <h3>
            <tr>
                <td><h3><?php echo $this->item->id . ':'; ?></h3></td>
                <td><h3><?php echo $this->item->title; ?></h3></td>
            </tr>
            </h3>
        </tbody>
    </table>

    <?php foreach ($this->items as $i => $row) : ?>
        <div class="row mt-5 col-3">
            <a class="btn btn-outline-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&id=' . $row->id . '?&question='. $row->questionNumber . '?&task=Display.questionDisplay') ?>"><?php echo Text::_("Question ") . $row->questionNumber; ?></a>
        </div>
    <?php endforeach; ?> 
</div>

