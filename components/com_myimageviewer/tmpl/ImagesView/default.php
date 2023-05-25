<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Kieran\Component\MyImageViewer\Site\Helper\CheckGroup;


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

	<!-- === MANAGE === -->
	<div class="col-10 row ps-5">
		<div class="col">
			<!-- User Check to see if they belong to Manager user group. Only managers should access this function -->
			<?php if (CheckGroup::isGroup("Manager")) : ?>
				<a class="btn" href="<?php echo Uri::getInstance()->current() . '?task=Display.categoryForm'; ?>">Manage</a>
			<?php endif; ?>
		</div>
		<div class="col text-center">
			<h3>Image Viewers</h3>
		</div>

		<!-- === SEARCH === -->
		<div class="col pl-3">
			<form 
				action="<?php echo Uri::getInstance()->current() . '?task=Display.display'?>"
				method="post"
				id="searchForm"
				name="searchForm"
				enctype="multipart/form-data"
			>
				<div class="row">
					<div class="col-11"><input type="text" id="searchText" name="searchText" class="form-control" placeholder="search..."/></div>
					<div class="col-1"><i id="searchIcon" class="icon-search icon-white"></i></div>
				</div>
				
			</form>
		</div>
		

		<!-- === NEW IMAGE === -->
		<div class="col">
			<!-- User Check to see if they belong to Manager user group. Only managers should access this function -->
			<?php if (CheckGroup::isGroup("Manager")) : ?>
				<a class="btn float-end" href="<?php echo Uri::getInstance()->current() . '?task=Display.imageForm'; ?>">
					<i class="icon-plus icon-white"></i> New
				</a>
			<?php endif; ?>
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
				<form action="<?php echo Uri::getInstance()->current() . '?&task=Display.hideImage' ?>"
						method="post"
						id="adminForm"
						name="adminForm"
						enctype="multipart/form-data" >
					
					<tr class="row">
						<?php if (!empty($this->items)) : ?>	
							<?php foreach ($this->items as $item) : ?>
							
								<!-- Render all images including hidden for managers, with manager functions -->
								<?php if (CheckGroup::isGroup("Manager")) : ?>
									<?php $render = true; ?>

								<!-- Only render images that aren't hidden for non-managers -->    
								<?php elseif ($item->isHidden == 0) : ?>
									<?php $render = true; ?>
								
								<!-- Image is hidden and shouldn't be viewed --> 
								<?php else : ?>
									<?php $render = false; ?>
								<?php endif; ?>
							
								<!-- Only show allowed elements -->
								<?php if ($render) : ?>	
									<td class="col-3 pt-3">
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

										<!-- HIDE QUIZ -->
										<div class="row">
											<?php if (CheckGroup::isGroup("Manager")) : ?>								

												<div class="row text-center">
													<label for="hideImage"><u><?php echo Text::_("Hide/Unhide") ?></u></label>
												</div>

												<div class="row">
													<div class="col-3 text-center">
														<input type="checkbox" id="hide" name="hide" value="<?php echo $item->id; ?>"/>
													</div>

													<?php if ($item->isHidden == 1) : ?>
															<div class="col-1"><i class="icon-delete"></i></div>
															<div class="col"><?php echo Text::_("Hidden") ?></div>
														<?php else : ?>
															<div class="col-1"><i class="icon-checkmark-circle"></i></div>
															<div class="col"><?php echo Text::_("Visible") ?></div>
														<?php endif; ?>																										
												</div>																																														
											<?php endif; ?>									
										</div>	
									</td>																			
								<?php endif; ?>	

							<?php endforeach; ?>
						<?php endif; ?>
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

<script>
    const hide = Array.from(document.getElementsByName("hide"));

	hide.forEach(box => {
		box.onclick = () => {
			let form = document.getElementById("adminForm");
			form.submit();  
		}
	});


	const search = document.getElementById("searchIcon");
	search.onclick = () => {
		let form = document.getElementById("searchForm");
		form.submit();
	}

</script>

