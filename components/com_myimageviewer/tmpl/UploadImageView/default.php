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

$selectedImage = "1";
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
	<div class="col-9 pe-5">
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

			<div class="form-group row">
				<label for="categoryId">Category:</label>

				<div class="col">
					<select id="uploadCategory" name="categoryId" class="form-control" required>
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
				
				<input type="file" name="imageUrl" class="form-control" required/>
			</div>

			<hr/>

			<div class="form-group">
				<label for="imageDescription">Description:</label>
				<textarea type="textarea" name="imageDescription" placeholder="Enter description..." rows="5" class="form-control"></textarea>
			</div>

			<hr/>
			
			<div class="form-group">
				<button class="btn col-auto" id="uploadImage-submit">
					<i class="icon-check icon-white"></i> Done
				</button>
			</div>
		</form>
	</div>
	
	<div id="image-list" class="col pt-3">
		<table class="w-100">
			<tbody>
				<?php foreach ($this->images as $row) : ?>
					<form
						action="<?php echo Uri::getInstance()->current() . '?&task=Form.deleteImage' ?>"
						method="post"
						enctype="multipart/form-data"
					>
						<input type="hidden" name="imageId" value="<?php echo $row->id; ?>"/>
						<input type="hidden" name="imageUrl" value="<?php echo $row->imageUrl; ?>">
						<tr class="row my-2">
							<td class="col">
								<?php echo $row->imageName; ?>
							</td>
							<td class="col">
								<?php echo $row->categoryName; ?>
							</td>
							<td class="col-auto">
								<button
									class="delete-button"
									id="deleteImage-submit"
								>
									<i class="icon-times icon-white"></i>
								</button>
							</td>
							
						</tr>
					</form>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>