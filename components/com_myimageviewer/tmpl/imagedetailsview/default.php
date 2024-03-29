<?php
/**
 * @package     Joomla.Site
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
$document->addScript("media/com_myimageviewer/js/imageDetailsView.js");
$document->addStyleSheet("media/com_myimageviewer/css/style.css");

?>

<!-- ========== FOCUS IMAGE VIEW ========== -->

<!-- Header -->
<div class="row mb-3">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current(); ?>">Back</a>
        <!-- User Check to see if they belong to Manager user group. Only managers should access these functions -->
        <?php if (CheckGroup::isGroup("Manager")) : ?>
            <button id="delete-button" class="btn float-end"><i class="icon-delete"></i> Delete</button>
            <a 
                class="btn me-3 float-end"
                href="<?php echo Uri::getInstance()->current()
                    . '?task=Display.editImageForm&id=' . $this->item->id
                    . '&categoryId=' . $this->item->categoryId;
                ?>"
            ><i class="icon-pencil"></i> Edit</a>
            <a 
                href="<?php echo Uri::getInstance()->current() . '?task=Form.toggleIsHidden&id=' . $this->item->id; ?>"
                class="btn me-3 float-end">

                <?php if($this->item->isHidden): ?>
                    <i class="icon-eye-open"></i> Show
                <?php else: ?>
                    <i class="icon-eye-close"></i> Hide
                <?php endif; ?>
            </a>
        <?php endif; ?>
	</div>
</div>

<!-- Main -->
<div class="row">
    <!-- Image -->
    <div class="col-6 position-relative">
        <button id="open-button" class="btn position-absolute m-2">View</button>
        <img class="w-100 rounded" src="<?php echo $this->item->url; ?>"/>
    </div>

    <!-- Title, category, description -->
    <div class="col-6 fixed-height-2">
        <h2 class="text-break"><?php echo $this->item->name; ?></h2>

        <h5>Category:
            <?php echo $this->item->category; ?>
            <?php if ($this->item->subcategory) echo ' - ' . $this->item->subcategory; ?>
        </h5>

        <hr/>

        <p class="text-break"><?php echo nl2br($this->item->description); ?></p>
    </div>
</div>

<!-- Focused viewer -->
<div id="focused-img-view" class="overlay-background d-none">
    <div class="h-100 text-center">
        <img id="focused-img" class="h-100" src="<?php echo $this->item->url; ?>"/>
    </div>
    <div id="controls-container" class="row fixed-top m-2">
        <div class="col"></div>

        <div id="controls" class="col-auto rounded">
            <div class="row">
                <div class="col rounded px-4 text-center">
                    <label for="brightness-input">Brightness</label>
                    <input type="range" min="50" max="250" id="brightness-input" class="form-range"/>
                </div>
                <div class="col-auto rounded mx-2 text-center">
                    Scroll to <br/> Zoom
                </div>
                <div class="col rounded px-4 text-center">
                    <label for="contrast-input">Contrast</label>
                    <input type="range" min="50" max="450" id="contrast-input" class="form-range"/>
                </div>
            </div>
        </div>

        <div class="col">
            <button id="exit-button" class="btn float-end rounded-circle"><i class="icon-times"></i></button>
        </div>
    </div>
</div>

<?php if (CheckGroup::isGroup("Manager")) : ?>
    <!-- Delete confirmation -->
    <div id="delete-confirmation" class="d-none">
        <form
            action="<?php echo Uri::getInstance()->current() . '?task=Form.deleteImage'; ?>"
            method="post"
            enctype="multipart/form-data"
        >
            <input type="hidden" name="imageId" value="<?php echo $this->item->id; ?>"/>
            <input type="hidden" name="imageUrl" value="<?php echo $this->item->url; ?>">

            <div class="overlay-background d-flex">
                <div class="m-auto text-center">
                    <h5 class="mb-4">Are you sure you want to remove <?php echo $this->item->name; ?>?<br/>This action cannot be undone.</h5>
                    <button id="delete-confirm" class="btn me-3">Yes, remove it</button>
                    <button id="delete-cancel" class="btn ms-3">No, go back</button> 
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>