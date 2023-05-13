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

$document = Factory::getDocument();
$document->addStyleSheet("media/com_myimageviewer/css/style.css");

?>

<!-- ========== UPLOAD IMAGE VIEW ========== -->

<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current() ?>">Back</a>
	</div>
	<div class="col-8 text-center">
		<h3>Manage Images</h3>
	</div>
	<div class="col"></div>
</div>

<hr/>

<div class="row">
	<div class="col-7 pe-5">
		<form 
			action="<?php echo Uri::getInstance()->current() . '?&task=Form.saveImage' ?>"
			method="post"
			id="adminForm"
			name="adminForm"
			enctype="multipart/form-data"
		>
			<div class="form-group">
				<label for="imageName">Name:</label>
				<input type="text" name="imageName" placeholder="Enter name..." class="form-control"/>
			</div>

			<hr/>

			<div class="form-group">
				<label for="imageDescription">Description:</label>
				<textarea type="textarea" name="imageDescription" placeholder="Enter description..." rows="5" class="form-control"></textarea>
			</div>

			<hr/>

			<div class="form-group row">
				<label for="categoryId">Category:</label>

				<div class="col">
					<select id="uploadCategory" name="categoryId" class="form-control">
						<?php foreach ($this->categories as $row) : ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="col-auto">
					<a
						href="<?php echo Uri::getInstance()->current() . '?&task=Display.addNewCategory' ?>"
						class="btn"
					>New Category</a>
				</div>
			</div>

			<hr/>

			<div class="form-group">
				<label for="imageUrl">File:</label>
				<input type="file" name="imageUrl" class="form-control"/>
			</div>
			
			<hr/>
			
			<div class="form-group">
				<button class="btn col-auto" id="uploadImage-submit" onclick="Joomla.submitbutton(Form.saveImage)"><i class="icon-check icon-white"></i> Done</button>
			</div>
		</form>
	</div>

	<div id="image-list" class="col-5 pt-3">
		<?php foreach ($this->images as $row) : ?>
			<div class="row my-2">
				<div class="col-2">
					<?php echo $row->imageName; ?>
				</div>
				<div class="col">
					<?php echo $row->categoryName; ?>
				</div>
				<div class="col-auto">
					<i class="icon-times icon-white"></i>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>