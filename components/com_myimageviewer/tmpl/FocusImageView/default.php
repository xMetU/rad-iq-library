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
$document->addScript("media/com_myimageviewer/js/focusImageView.js");
$document->addStyleSheet("media/com_myimageviewer/css/style.css");
$document->addStyleSheet("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

?>

<!-- ========== FOCUS IMAGE VIEW ========== -->

<!-- Header -->
<div class="row mb-3">
    <div class="col-3">
        <a class="btn" href="<?php echo Uri::getInstance()->current() . '?&task=Display.display' ?>">Back</a>
    </div>
</div>

<!-- Main -->
<div class="row">
    <!-- Image -->
    <div class="col-7 pe-5 position-relative">
        <button id="focus-button" class="btn position-absolute m-2 p-1">Open</button>
        <img class="w-100 rounded" src="<?php echo $this->item->url; ?>"/>
    </div>

    <!-- Name, category, description -->
    <div id="img-description" class="col-5">
        <h2><?php echo $this->item->name; ?></h2>

        <h5>Category: <?php echo $this->item->category; ?></h5>

        <hr/>

        <p><?php echo $this->item->description; ?></p>
    </div>
</div>

<!-- Focused viewer -->
<div id="focused-img-view" class="text-center d-none">
    <div class="h-100">
        <img id="focused-img" class="h-100" src="<?php echo $this->item->url; ?>"/>
    </div>
    <div id="controls-container" class="row fixed-top justify-content-center m-2">
        <div class="col"></div>

        <div id="controls" class="col-4 d-flex align-items-center rounded">
            <label class="px-2">Contrast: </label>
            <input type="range" min="20" max="420" id="contrast-input"/>
        </div>

        <div class="col">
            <button id="exit-button" class="btn float-end rounded-circle">&#x2715;</button>
        </div>
    </div>
</div> 