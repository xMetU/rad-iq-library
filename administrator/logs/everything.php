#
#<?php die('Forbidden.'); ?>
#Date: 2023-05-15 10:25:22 UTC
#Software: Joomla! 4.2.9 Stable [ Uaminifu ] 14-March-2023 15:00 GMT

#Fields: datetime	priority clientip	category	message
2023-05-15T10:25:22+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.80 seconds
2023-05-15T10:25:23+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-05-15T10:25:35+00:00	INFO 127.0.0.1	updater	Loading information from update site #2 with name "Accredited Joomla! Translations" and URL https://update.joomla.org/language/translationlist_4.xml took 0.65 seconds
2023-05-15T10:25:36+00:00	INFO 127.0.0.1	updater	Loading information from update site #3 with name "Joomla! Update Component" and URL https://update.joomla.org/core/extensions/com_joomlaupdate.xml took 0.66 seconds
2023-05-16T09:38:00+00:00	INFO 127.0.0.1	updater	Loading information from update site #1 with name "Joomla! Core" and URL https://update.joomla.org/core/list.xml took 0.35 seconds
2023-05-16T09:38:00+00:00	WARNING 127.0.0.1	jerror	The mail function has been disabled by an administrator.
2023-05-16T12:17:06+00:00	CRITICAL 127.0.0.1	error	Uncaught Throwable of type Joomla\CMS\Component\Exception\MissingComponentException thrown with message "Component not found.". Stack trace: #0 [ROOT]\libraries\src\Application\SiteApplication.php(208): Joomla\CMS\Component\ComponentHelper::renderComponent(NULL)
#1 [ROOT]\libraries\src\Application\SiteApplication.php(249): Joomla\CMS\Application\SiteApplication->dispatch()
#2 [ROOT]\libraries\src\Application\CMSApplication.php(294): Joomla\CMS\Application\SiteApplication->doExecute()
#3 [ROOT]\includes\app.php(61): Joomla\CMS\Application\CMSApplication->execute()
#4 [ROOT]\index.php(32): require_once('C:\\xampp\\htdocs...')
#5 {main}
