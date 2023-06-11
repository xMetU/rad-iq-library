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
$document->addScript("media/com_myimageviewer/js/categoryFormView.js");
$document->addStyleSheet("media/com_myimageviewer/css/style.css");


?>

<!-- ========== ADD NEW CATEGORY VIEW ========== -->

<!-- Header -->
<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo $this->toQuiz ? "index.php/quizzes" : Uri::getInstance()->current(); ?>">Back</a>
	</div>
	<div class="col-8 text-center">
		<h3>Manage Categories</h3>
	</div>
	<div class="col"></div>
</div>

<hr/>

<div class="row">
	<div class="col">
		<h4 class="text-center">Create New Category</h4>
	</div>
	<div class="col">
		<h4 class="text-center">Remove Category</h4>
	</div>
</div>

<div class="row justify-content-center mt-3">
	<div class="col">
		<!-- Create form -->
		<form 
			action="<?php echo Uri::getInstance()->current() . '?task=Form.saveCategory'; ?>"
			method="post"
			id="adminForm"
			name="adminForm"
			enctype="multipart/form-data"
		>
			<div class="row form-group p-2">
				

				<div class="col">
					<label for="categoryName">Category Name: *</label>

					<input
						type="text"
						name="categoryName"
						class="form-control"
						placeholder="Enter name..."
						maxlength="30"
						required
					/>
				</div>

				<div class="col-auto">
					<button class="btn mt-4">
						<i class="icon-check"></i> Done
					</button> 
				</div>
			</div>
		</form>
	</div>

	<div class="col-1"></div>

	<div class="col">
		<!-- Delete form -->
		<form 
			action="<?php echo Uri::getInstance()->current() . '?task=Form.deleteCategory'; ?>"
			method="post"
			name="adminForm"
		>	
			<div class="row form-group p-3 bg-danger">

				<div class="col">
					<label for="categoryId">Category Name: *</label>

					<select id="delete-select" name="categoryId" class="form-control form-select" required>
						<option value="" selected disabled hidden>Select a category</option>
						<?php foreach ($this->categories as $row) : ?>
							<option value="<?php echo $row->categoryId; ?>"><?php echo $row->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-auto">
					<button id="delete-button" class="btn mt-4">
						<i class="icon-times"></i> Remove
					</button> 
				</div>
			</div>
		
			<!-- Delete confirmation -->
			<div id="delete-confirmation" class="overlay-background d-flex d-none">
				<div class="m-auto text-center">
					<h5 class="mb-4"><!-- Message --></h5>
					<button id="delete-confirm" class="btn me-3">Yes, remove it</button>
					<button id="delete-cancel" class="btn ms-3">No, go back</button>
				</div>
			</div>
		</form>	
	</div>
</div>
	
<hr/>



<div class="row justify-content-center mt-5">
	<div class="col">
		<h4 class="text-center">Create New Subcategory</h4>
	</div>
	<div class="col">
		<h4 class="text-center">Remove Subcategory</h4>
	</div>
</div>

<div class="row justify-content-center mt-3">
	<div class="col">
		<!-- Create form -->
		<form 
			action="<?php echo Uri::getInstance()->current() . '?task=Form.saveSubcategory'; ?>"
			method="post"
			id="adminForm"
			name="adminForm"
			enctype="multipart/form-data"
		>
			

			<div class="row form-group mt-5">
				
				<div class="col">
					<label for="categoryName">Subcategory Name: *</label>

					<input
						type="text"
						name="subcategoryName"
						class="form-control"
						placeholder="Enter name..."
						maxlength="30"
					/>
				</div>
			</div>

			<div class="row form-group mt-4">
				<h5 class="text-center">Assign Parent Category</h5>

				<div class="col">
					<label for="categoryId">Parent Category Name: *</label>

					<select id="parent-category-select" name="categoryId" class="form-control form-select" required>
						<option value="" selected disabled hidden>Select a parent category</option>
						<?php foreach ($this->categories as $row) : ?>
							<option value="<?php echo $row->categoryId; ?>"><?php echo $row->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-auto">
					<button class="btn mt-4">
						<i class="icon-check"></i> Done
					</button> 
				</div>
			</div>
		</form>
	</div>

	<div class="col-1"></div>

	<div class="col bg-danger p-3">
		<!-- Delete form -->
		<form 
			action="<?php echo Uri::getInstance()->current() . '?task=Form.deleteSubcategory'; ?>"
			method="post"
			name="adminForm"
		>	
			<div class="row form-group">
				<h5 class="text-center">Select Parent Category</h5>

				<div class="col">
					<label for="categoryId">Parent Category Name: *</label>

					<select id="delete-parent-category-select" name="categoryId" class="form-control form-select" required>
						<option value="" selected disabled hidden>Select a parent category</option>
						<?php foreach ($this->categories as $row) : ?>
							<option value="<?php echo $row->categoryId; ?>"><?php echo $row->categoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="row form-group mt-4">
				<h5 class="text-center">Remove Subcategory</h5>

				<div class="col">
					<label for="subcategoryId">Subcategory Name: *</label>

					<select id="subcategory-select" name="subcategoryId" class="form-control form-select" required>

						<?php if (!$this->subcategories) : ?>
							<option value="">No subcategories</option>
						<?php endif ?>

						<option value="" selected disabled hidden>Select a subcategory</option>
						<?php foreach ($this->subcategories as $row) : ?>
							<option value="<?php echo $row->subcategoryId; ?>"><?php echo $row->subcategoryName; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-auto">
					<button id="delete-button" class="btn mt-4">
						<i class="icon-times"></i> Remove
					</button> 
				</div>

				<!-- Delete confirmation -->
				<div id="delete-confirmation" class="overlay-background d-flex d-none">
					<div class="m-auto text-center">
						<h5 class="mb-4"><!-- Message --></h5>
						<button id="delete-confirm" class="btn me-3">Yes, remove it</button>
						<button id="delete-cancel" class="btn ms-3">No, go back</button>
					</div>
				</div>
			</div>
			
		</form>	
	</div>
</div>
	
<hr/>


<script>

	const parent = document.getElementById("delete-parent-category-select");
	
	parent.onchange = (e) => {
		var catId = document.getElementById("delete-parent-category-select").value;
		window.location.href = `?task=Display.categoryForm&categoryId=${catId}`;
	}

	if("<?php echo $this->categoryId; ?>") {
		for(i= 0; i < parent.options.length; i++) {
			if(parent.options[i].value == "<?php echo $this->categoryId; ?>") {
				parent.options[i].selected = true;
			}
		}
	}
	
</script>



