<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 *
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

?>

<!-- ========== Add Category Form ============================== -->
<form action="<?php echo Uri::getInstance()->current() . '?&task=Form.saveCategory' ?>" method="post" id="adminForm" name="adminForm">
	<table class="table table-hover mt-5">
		<tbody>
			<tr>
				<td>
					<?php echo $this->form->renderFieldSet('addNewCategory'); ?>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="mt-5">
		<button class="btn btn-primary" id="addNewCategory-submit" onclick="Joomla.submitbutton(Form.saveCategory)"></i><?php echo Text::_(' CREATE CATEGORY!'); ?></button> 
	</div>

</form>

<div class="mt-5">
	<a class="mt-5 btn btn-outline-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=Display.uploadForm') ?>"><?php echo Text::_('BACK'); ?></a>
</div>



