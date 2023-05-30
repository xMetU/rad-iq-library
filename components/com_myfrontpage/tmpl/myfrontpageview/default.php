<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_myFrontPage
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

$document = Factory::getDocument();
$document->addScript("media/com_myfrontpage/js/myFrontPageView.js");
$document->addStyleSheet("media/com_myfrontpage/css/style.css");

?>


<!-- ====== Front Page View =========== -->


<div class="row">
    <div id="title" class="text-center">
			<h1><u>WELCOME TO MED RAD IMAGING LIBRARY</u></h1>
			<h3>An X-Ray Image Repository and Learning Resource</h3>
	</div>
</div>

</hr>
</br>
<div>
	<div class="text-center">
		<p>Some text will go here that will further describe the website.</p>
		<p>Text content to be confirmed.</p>
	</div>
</div>


