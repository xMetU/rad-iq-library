#
#<?php die('Forbidden.'); ?>
#Date: 2023-04-15 07:48:51 UTC
#Software: Joomla! 4.2.9 Stable [ Uaminifu ] 14-March-2023 15:00 GMT

#Fields: datetime	priority clientip	category	message
2023-04-15T07:48:51+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.menu.1 Array (     [0] => 1 ) 
2023-04-15T07:49:04+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.menu.1 Array ( ) 
2023-04-15T07:49:14+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.101 Array (     [0] => 101 ) 
2023-04-15T07:49:43+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.101 Array ( ) 
2023-04-15T07:50:05+00:00	INFO 127.0.0.1	controller	Holding edit ID com_templates.edit.style.11 Array (     [0] => 11 ) 
2023-04-15T07:50:08+00:00	INFO 127.0.0.1	controller	Checking edit ID com_templates.edit.style.11: 1 Array (     [0] => 11 ) 
2023-04-15T07:50:39+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_templates.edit.style.11 Array ( ) 
2023-04-15T07:51:20+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.101 Array (     [0] => 101 ) 
2023-04-15T07:51:34+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.101 Array ( ) 
2023-04-15T07:55:08+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.101 Array (     [0] => 101 ) 
2023-04-15T07:55:32+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.101 Array ( ) 
2023-04-15T07:57:36+00:00	INFO 127.0.0.1	controller	Holding edit ID com_modules.edit.module.1 Array (     [0] => 1 ) 
2023-04-15T07:57:39+00:00	INFO 127.0.0.1	controller	Checking edit ID com_modules.edit.module.1: 1 Array (     [0] => 1 ) 
2023-04-15T07:58:08+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_modules.edit.module.1 Array ( ) 
2023-04-15T08:05:49+00:00	INFO 127.0.0.1	controller	Holding edit ID com_menus.edit.item.103 Array (     [0] => 103 ) 
2023-04-15T08:06:15+00:00	INFO 127.0.0.1	controller	Releasing edit ID com_menus.edit.item.103 Array ( ) 
2023-04-15T08:33:29+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Router\Exception\RouteNotFoundException thrown with message "Page not found". Stack trace: #0 [ROOT]\libraries\src\Application\SiteApplication.php(744): Joomla\CMS\Router\Router->parse(Object(Joomla\CMS\Uri\Uri), true)
#1 [ROOT]\libraries\src\Application\SiteApplication.php(232): Joomla\CMS\Application\SiteApplication->route()
#2 [ROOT]\libraries\src\Application\CMSApplication.php(294): Joomla\CMS\Application\SiteApplication->doExecute()
#3 [ROOT]\includes\app.php(61): Joomla\CMS\Application\CMSApplication->execute()
#4 [ROOT]\index.php(32): require_once('C:\\xampp\\htdocs...')
#5 {main}
2023-04-15T08:46:00+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "View not found [name, type, prefix]: myImageViewerView, html, Administrator". Stack trace: #0 [ROOT]\libraries\src\MVC\Controller\BaseController.php(602): Joomla\CMS\MVC\Controller\BaseController->getView('myImageViewerVi...', 'html', 'Administrator', Array)
#1 [ROOT]\administrator\components\com_myimageviewer\src\Controller\DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display(false, Array)
#2 [ROOT]\libraries\src\MVC\Controller\BaseController.php(672): Kieran\Component\MyImageViewer\Administrator\Controller\DisplayController->display()
#3 [ROOT]\libraries\src\Dispatcher\ComponentDispatcher.php(143): Joomla\CMS\MVC\Controller\BaseController->execute('display')
#4 [ROOT]\libraries\src\Component\ComponentHelper.php(355): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#5 [ROOT]\libraries\src\Application\AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent('com_myimageview...')
#6 [ROOT]\libraries\src\Application\AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#7 [ROOT]\libraries\src\Application\CMSApplication.php(294): Joomla\CMS\Application\AdministratorApplication->doExecute()
#8 [ROOT]\administrator\includes\app.php(61): Joomla\CMS\Application\CMSApplication->execute()
#9 [ROOT]\administrator\index.php(32): require_once('C:\\xampp\\htdocs...')
#10 {main}
2023-04-15T08:56:56+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Exception thrown with message "Layout default not found.". Stack trace: #0 [ROOT]\libraries\src\MVC\View\HtmlView.php(203): Joomla\CMS\MVC\View\HtmlView->loadTemplate(NULL)
#1 [ROOT]\administrator\components\com_myimageviewer\src\View\myImageViewerView\HtmlView.php(23): Joomla\CMS\MVC\View\HtmlView->display(NULL)
#2 [ROOT]\libraries\src\MVC\Controller\BaseController.php(639): Kieran\Component\MyImageViewer\Administrator\View\MyImageViewerView\HtmlView->display()
#3 [ROOT]\administrator\components\com_myimageviewer\src\Controller\DisplayController.php(24): Joomla\CMS\MVC\Controller\BaseController->display(false, Array)
#4 [ROOT]\libraries\src\MVC\Controller\BaseController.php(672): Kieran\Component\MyImageViewer\Administrator\Controller\DisplayController->display()
#5 [ROOT]\libraries\src\Dispatcher\ComponentDispatcher.php(143): Joomla\CMS\MVC\Controller\BaseController->execute('display')
#6 [ROOT]\libraries\src\Component\ComponentHelper.php(355): Joomla\CMS\Dispatcher\ComponentDispatcher->dispatch()
#7 [ROOT]\libraries\src\Application\AdministratorApplication.php(143): Joomla\CMS\Component\ComponentHelper::renderComponent('com_myimageview...')
#8 [ROOT]\libraries\src\Application\AdministratorApplication.php(186): Joomla\CMS\Application\AdministratorApplication->dispatch()
#9 [ROOT]\libraries\src\Application\CMSApplication.php(294): Joomla\CMS\Application\AdministratorApplication->doExecute()
#10 [ROOT]\administrator\includes\app.php(61): Joomla\CMS\Application\CMSApplication->execute()
#11 [ROOT]\administrator\index.php(32): require_once('C:\\xampp\\htdocs...')
#12 {main}
2023-04-15T08:58:23+00:00	INFO 127.0.0.1	update	Start of SQL updates.
2023-04-15T08:58:23+00:00	INFO 127.0.0.1	update	The current database version (schema) is 0.0.3.
2023-04-15T08:58:23+00:00	INFO 127.0.0.1	update	End of SQL updates.
2023-04-15T09:06:35+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.68 seconds
2023-04-15T09:06:35+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.64 seconds
2023-04-15T09:06:36+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.64 seconds
2023-04-19T17:05:14+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.31 seconds
2023-04-19T17:05:15+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-04-19T17:05:30+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.64 seconds
2023-04-19T17:05:31+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.63 seconds
2023-04-19T17:07:28+00:00	WARNING 127.0.0.1	jerror	JInstaller: :Install: File does not exist [ROOT]\tmp\install_64401fd0d4dd6\com_myImageViewer\media\js
2023-04-21T19:53:06+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.34 seconds
2023-04-21T19:53:07+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-04-21T19:53:18+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.63 seconds
2023-04-21T19:53:19+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.63 seconds
2023-04-24T13:52:59+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 1.82 seconds
2023-04-24T13:52:59+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-04-24T13:53:21+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.64 seconds
2023-04-24T13:53:22+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.64 seconds
2023-04-27T17:47:04+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.99 seconds
2023-04-27T17:47:05+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-04-27T17:47:16+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.63 seconds
2023-04-27T17:47:17+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.64 seconds
2023-04-27T17:56:07+00:00	WARNING 127.0.0.1	jerror	Cannot delete or update a parent row: a foreign key constraint fails
2023-05-03T18:01:35+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.84 seconds
2023-05-03T18:01:35+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-05-03T18:01:46+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.66 seconds
2023-05-03T18:01:47+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.64 seconds
