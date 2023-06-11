<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$document = Factory::getDocument();
$document->addScript("media/com_myimageviewer/js/imageFormView.js");
$document->addStyleSheet("media/com_myimageviewer/css/style.css");

?>

<!-- ========== EDIT IMAGE FORM VIEW ========== -->

<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current() ?>">Back</a>
	</div>

	<div class="col-8 text-center">
		<h3><?php echo "Edit " . $this->image->name; ?></h3>
	</div>

	<div class="col"></div>
</div>

<hr/>



<div class="row justify-content-center">

	<div class="col-8">
		<form 
			action="<?php echo Uri::getInstance()->current() . '?task=Form.updateImage'; ?>"
			method="post"
			id="adminForm"
			name="adminForm"
			enctype="multipart/form-data"
		>
			<input type="hidden" name="imageId" value="<?php echo $this->image->id; ?>"/>

			<div class="form-group">
				<label for="imageName">Title: *</label>

				<input 
					type="text"
					name="imageName"
					class="form-control"
					placeholder="Enter title..."
					maxlength="60"
					required
					value="<?php echo $this->image ? $this->image->name : ""; ?>"
				/>
			</div>

			<hr/>

			<div class="row form-group">
				<div class="col-6">
					<label for="categoryId">Category: *</label>

					<select
						id="editImageCategory"
						name="categoryId"
						class="form-control form-select"
						required
					>
						<?php foreach ($this->categories as $row) : ?>
							<option value="<?php echo $row->categoryId; ?>"
								<?php if ($row->categoryId == $this->categoryId) : ?>
									<?php echo "selected"; ?>
								<?php endif ?>
							>
								<?php echo $row->categoryName; ?>								
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-6">
					<label for="subcategoryId">Subcategory: </label>

					<select
						id="editImageSubcategory"
						name="subcategoryId"
						class="form-control form-select"
					>
						<?php if (!$this->subcategories) : ?>
							<option value="">No subcategories</option>
						<?php endif ?>

						<?php foreach ($this->subcategories as $row) : ?>													
							<option value="<?php echo $row->subcategoryId; ?>" 										
								<?php if($this->image && $row->categoryId == $this->image->categoryId) : ?>
									<?php if($row->subcategoryId == $this->image->subcategoryId) : ?>
										<?php echo "selected"; ?>
									<?php endif ?>
								<?php endif ?>
							>										
								<?php echo $row->subcategoryName; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>	
			</div>
			
			<hr/>

			<div class="row">
				<div>
					<label for="imageUrl">File: *</label>

					<input 
						type="file"
						name="imageUrl"
						class="form-control"
						accept=".png,.jpg,.jpeg,.gif"
						disabled
					/>
				</div>
			</div>

			<hr/>

			<div class="form-group">
				<label for="imageDescription">Description:</label>

				<textarea
					name="imageDescription"
					class="form-control"
					placeholder="Enter description..."
					maxlength="12000"
					rows="16"
				><?php echo $this->image->description; ?></textarea>
			</div>

			<hr/>
			
			<div class="form-group">
				<button class="btn col-auto">
					<i class="icon-check"></i> Done
				</button>
			</div>
		</form>
	</div>
</div>


<script>
	const parent = document.getElementById("editImageCategory");
	const sub = document.getElementById("editImageSubcategory");
	var imageId = "<?php echo $this->image->id; ?>";
	var catId = "<?php echo $this->categoryId; ?>";

	parent.onchange = (e) => {
		var changeId = document.getElementById("editImageCategory").value;
		window.location.href = `?task=Display.editImageForm&id=${imageId}&categoryId=${changeId}`;	
	}

	sub.onchange = (e) => {
		var changeId = document.getElementById("editImageSubcategory").value;
		window.location.href = `?task=Display.editImageForm&id=${imageId}&categoryId=${catId}&subcategoryId=${changeId}`;
	}
</script>