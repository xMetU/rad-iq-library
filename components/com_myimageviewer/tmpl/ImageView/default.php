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


<h2 class="text-center bg-primary text-white">This is the Site side of My Image Viewer</h2>


<!-- Display all files -->
<table>
	<thead>
		<tr>
			<th>
				<?php echo HtmlHelper::_('grid.checkall'); ?>
			</th>
			<th>
				<?php echo Text::_('ID') ;?>
			</th>
			<th>
				<?php echo Text::_('Image'); ?>
			</th>
			<th>
				<?php echo Text::_('Name'); ?>
			</th>
			<th>
				<?php echo Text::_('Category'); ?>
			</th>
		</tr>	
	</thead>
	<tfoot>
		<tr>
			<td>
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php if (!empty($this->items)) : ?>
			<?php foreach ($this->items as $i => $row) : ?>

				<tr>
					<td class="col-1">
						<?php echo HtmlHelper::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="col-1">
						<?php echo $row->id; ?>
					</td>
					<td class="col-3">
						<img src="<?php echo $row->imageUrl; ?>" style="width:150px;height:180px;"/>
					</td>
					<td class="col-2">
						<?php echo $row->imageName; ?>
					</td>
					<td class="col-2">
						<?php echo $row->imageCategory; ?>
					</td>

					<td align="center">
						<?php echo $row->id; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
