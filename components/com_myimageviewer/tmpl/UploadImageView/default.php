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


<!--==================== Upload image Form =========================-->
<form action="<?php echo Uri::getInstance()->current() . '?&task=Form.saveImage' ?>" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
	<table class="table table-hover mt-5">
		<tbody>

			<!--==================== Image Name =========================-->
			<tr>
				<td>
					<?php echo Text::_('NAME'); ?>:
				</td>
				<td>
					<input type="text" name="imageName" class="form-control"/>
				</td>
			</tr>

			<!--==================== Image Description =========================-->
			<tr>
				<td>
					<?php echo Text::_('DESCRIPTION'); ?>:
				</td>
				<td>
					<input type="textarea" name="imageDescription" class="form-control"/>
				</td>
			</tr>

			<!--==================== Image Category Select =========================-->
			<tr>
				<td>
					<?php echo Text::_('CATEGORY'); ?>:
				</td>
				<td>
					<!-- Drop down list to display the categories -->
					<select id="uploadCategory" name="categoryId" class="form-control">
						<?php foreach ($this->categories as $c => $row) : ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</td>

				<!--==================== New Category =========================-->
				<td>
					<a href="<?php echo Uri::getInstance()->current() . '?&task=Display.addNewCategory' ?>" class="btn btn-outline-primary"><?php echo Text::_('NEW CATEGORY'); ?></a>
				</td>
			</tr>

			<tr>
				<td><?php echo Text::_('FILENAME');?>:</td>
				<td>
					<input type="file" name="imageUrl" class="form-control"/>
					<button class="btn btn-primary" id="uploadImage-submit" onclick="Joomla.submitbutton(Form.saveImage)"><i class="icon-upload icon-white"></i><?php echo Text::_(' SAVE'); ?></button>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<div>
	<a class="mt-5 btn btn-outline-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&task=Display.display') ?>"><?php echo Text::_('BACK'); ?></a>
</div>



