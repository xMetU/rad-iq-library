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
?>


<h2 class="text-center bg-primary text-white">This is the New View</h2>


<!-- Upload image Form -->
<form action="index.php?option=com_myImageViewer&view=myImageViewer" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><?php echo Text::_('FILENAME');?>:</td>
				<td>
					<input type="file" id="file-upload" name="Filedata" class="form-control" /><?php
					?><button class="btn btn-primary" id="file-upload-submit"><i class="icon-upload icon-white"></i><?php echo Text::_('START UPLOAD'); ?></button>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo Text::_('TITLE'); ?>:
				</td>
				<td>
					<input type="text" id="myImageViewer-upload-title" name="myImageVieweruploadtitle" value=""  maxlength="255" class="form-control" />
				</td>
			</tr>
			<tr>
				<td>
					<?php echo Text::_('CATEGORY'); ?>:
				</td>
				<td>
					<!-- Drop down list to display the categories -->
					<label for="category">Select Category:</label>
					<select id="myImageViewer-Upload-Category" name="myImageViewerUploadCategory" class="form-control">
						<?php foreach ($this->items as $i => $row) : ?>
							<option value="<?php echo $row->imageCategory; ?>"><?php echo $row->imageCategory; ?></option>
						<?php endforeach; ?>
					</select>
					<button class="btn btn-outline-primary">New Category</button>
				</td>
			</tr>

			<tr>
				<td><?php echo Text::_('DESCRIPTION'); ?>:</td>
				<td>
					<textarea id="myImageViewer-Upload-Description" name="myImageViewerUploadDescription" 
					onkeyup="countCharsUpload('<?php echo $this->t['upload_form_id']; ?>');" cols="30" rows="10" 
					class="form-control"></textarea>
				</td>
			</tr>
	</table>
</form>

