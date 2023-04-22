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
$document->addScript("media/com_myimageviewer/js/imageView.js");
$document->addStyleSheet("media/com_myimageviewer/css/imageView.css");

?>

<!-- ========== IMAGE VIEW ========== -->

<!-- Categories -->
<div class="row">
	<div id="sidenav" class="col-2 text-center">
		<table class="w-100">
			<tbody>
				<?php if (!empty($this->buttonCategories)) : ?>
					<?php foreach ($this->buttonCategories as $category) : ?>
						<tr>
							<td>
								<a
									class="btn btn-secondary d-flex justify-content-center"
									href="<?php echo Uri::getInstance()->current() . Route::_('?imageCategory='. $category->categoryName . '&task=Display.changeImageList') ?>"
								>
									<?php echo $category->categoryName; ?>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

	<div class="col-10">
		<table class="table table-borderless">
			<tfoot>
				<tr class="border-top">
					<td colspan="3">
						<div class="d-flex justify-content-center">
							<?php echo $this->pagination->getListFooter(); ?>
						</div>
					</td>
				</tr>
			</tfoot>

			<tbody id="images">
				<?php if (!empty($this->items)) : ?>
					<?php foreach (array_chunk($this->items, 3) as $row) : ?>
						<tr>
							<?php foreach ($row as $item) : ?>
								<td class="p-0">
									<div class="card">
										<img
											id="<?php echo $item->id; ?>"
											class="card-img-top"
											src="<?php echo $item->imageUrl; ?>"
										/>
										<div class="card-body">
											<h5 class="card-title"><?php echo $item->imageName; ?></h5>
										</div>
									</div>
								</td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>	
</div>