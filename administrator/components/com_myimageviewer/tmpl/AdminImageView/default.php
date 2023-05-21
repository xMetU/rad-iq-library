<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myImageViewer
 *
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

?>


<h2 class="text-center bg-primary text-white">Image Visibility</h2>


        
<div>
    <form action="<?php echo Uri::getInstance()->current() . '?option=com_myimageviewer&task=Display.hideImage' ?>"
        method="post"
        id="adminForm"
        name="adminForm"
        enctype="multipart/form-data" >
    
        <table>
            <thead>
                <th class="col-1"><?php echo Text::_("Hide/Unhide Image") ?></th>
                <th class="col-1"></th>
                <th class="col-1"><?php echo Text::_("Image Hidden") ?></th>
                <th class="col-2"><?php echo Text::_("Title") ?></th>
                <th class="col-2"><?php echo Text::_("Category") ?></th>
                <th class="col-3"><?php echo Text::_("Image") ?></th>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $row) : ?>
                    <tr>
                        <div class="form-group">
                            <td><input type="checkbox" name="<?php echo $row->id; ?>" value="<?php echo $row->id; ?>"/></td>
                        </div>  

                        <?php if ($row->isHidden == 1) : ?>
                            <td><i class="icon-delete"></i></td>
                            <td><?php echo Text::_("Hidden") ?></td>
                        <?php else : ?>
                            <td><i class="icon-checkmark-circle"></i></td>
                            <td><?php echo Text::_("Visible") ?></td>
                        <?php endif; ?>  
                                        
                        <td><?php echo $row->imageName; ?></td>
                        <td><?php echo $row->categoryName; ?></td>
                        <td><img id="<?php echo $row->imageId; ?>" src="<?php echo Uri::root() . '/' . $row->imageUrl; ?>" style="width:150px;height:180px;"/></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="row mt-5">
            <div class="col-6 form-group">
                <button class="btn btn-primary" id="quizVisible-submit" onclick="Joomla.submitbutton(Display.hideImage)">Toggle Image Visibility</button>
            </div>
        </div>
    </form>
</div>






