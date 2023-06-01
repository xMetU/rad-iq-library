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
		<h1>MedRad IQ Library</h1>
		<h3 class="text-info">Imaging Repository and Learning Resource</h3>

	</div>
</div>

	<hr>
	</br>
	</br>
	<div id="textBox" class="mt-3 p-4">
		<div>
			<p>Welcome to MedRad IQ Library, a web-based application which aims to serve as a comprehensive resource for Medical Imaging students.
			<p>Housing a comprehensive collection of radiographic images and content, MedRad IQ Library is designed to facilitate a deeper understanding of Medical Imaging Studies (RADY) courses. 
				It presents real-world cases and images, providing contemporary and relevant insights into the field of medical imaging. 
				Furthermore, self-assessment modules and quizzes are integrated into the platform, providing an opportunity for students to evaluate their learning progress.</p>
			<p>By offering access to practical cases and industry-relevant images, the platform hopes to provide an essential resource for those looking to forge a career in medical imaging. 
				The platform hopes to encourage further exploration and continuous learning for our Medical Imaging students.</p>
			<p>This platform is a product from a collaboration between STEM and Allied Health & Human Performance Academic Units at University of South Australia.</p>
		</div>
	</div>





