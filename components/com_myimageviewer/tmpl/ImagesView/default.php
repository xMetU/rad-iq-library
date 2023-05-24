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
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

$document = Factory::getDocument();
$document->addScript("media/com_myimageviewer/js/imagesView.js");
$document->addStyleSheet("media/com_myimageviewer/css/style.css");

?>

<!-- ========== IMAGE VIEW ========== -->

<!-- Headers -->
<div class="row pb-3">
	<div class="col-2 text-center my-auto">
		<h6>Filter by Category</h6>
	</div>
	<div class="col-10 row ps-5">
		<div class="col">
			<a class="btn" href="<?php echo Uri::getInstance()->current() . '?task=Display.categoryForm'; ?>">Manage Categories</a>
		</div>
		<div class="col text-center">
			<h3>Image Viewers</h3>
		</div>
		<div class="col">
			<a class="btn float-end" href="<?php echo Uri::getInstance()->current() . '?task=Display.imageForm'; ?>">
				<i class="icon-plus icon-white"></i> New
			</a>
		</div>
	</div>
</div>

<div class="row">
	<!-- Categories -->
	<div class="col-2 fixed-height">
		<table id="categories" class="w-100">
			<tbody>
				<?php if (!empty($this->categories)) : ?>
					<?php foreach ($this->categories as $row) : ?>
						<tr>
							<td class="pb-3">
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

	<!-- Images -->
	<div class="col-10 row ps-5 fixed-height">
		<table id="images" class="table table-borderless">
			<tfoot>
				<tr>
					<td class="d-flex justify-content-center p-2" colspan="3">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>

			<tbody>
				<?php if (!empty($this->items)) : ?>
					<tr class="row">
						<?php foreach ($this->items as $item) : ?>
							<td class="col-3 pt-0 pb-3 px-3">
								<div class="card p-3 pb-0">
									<img
										id="<?php echo $item->id; ?>"
										class="card-img-top"
										src="<?php echo $item->imageUrl; ?>"
									/>
									<div class="card-body text-center p-2">
										<h5 class="text-truncate"><?php echo $item->imageName; ?></h5>
									</div>
								</div>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php else: ?>
					<tr>
						<td>
							<p class="text-secondary text-center pt-5">No image viewers are assigned to this category</p>
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>	
</div>

