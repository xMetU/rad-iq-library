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


<div>
	<div id="title" class="text-center mt-5">
		<h1>WELCOME TO THE MED RAD IMAGING LIBRARY</h1>
		<h3>X-Ray Image Repository and Learning Resource</h3>

	</div>
</div>

	<hr>
	</br>
	</br>
	<div class="mt-5">
		<div class="text-center">
			<p>Some text will go here that will further describe the website.</p>
			<p>Text content to be confirmed.</p>
		</div>
	</div>





