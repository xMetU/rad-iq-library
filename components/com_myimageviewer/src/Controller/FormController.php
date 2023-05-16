<?php

namespace Kieran\Component\MyImageViewer\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\File;


/**
 * @package     Joomla.Site
 * @subpackage  com_myImageViewer
 */

class FormController extends BaseController {
    

    public function saveImage() {            

		$model = $this->getModel('UploadImage');
		
		$data = $_POST;
		$file = Factory::getApplication()->input->files->get('imageUrl');		
		
		$name = $file['name'];
		$tmp = $file['tmp_name'];

		$path = JPATH_ROOT . '/media/com_myImageViewer/images/';
		$categoryName = $model->getCategory($data['categoryId'])->categoryName;


		$folderUrl = $path . $categoryName;
		$uploadUrl = $path . $categoryName . '/' . $name;

		$imageUrl = 'media/com_myImageViewer/images/' . $categoryName . '/' . $name;


		Folder::create($folderUrl);
		File::upload($tmp, $uploadUrl);

		array_push($data, $imageUrl);
		// $validData = $model->validate($form, $data);

		$model->saveImage($data);

        $this->setRedirect(Route::_('index.php?option=com_myImageViewer&view=ImageView', false));
    }



    public function cancelImage($key = null) {
        Factory::getApplication()->enqueueMessage("FormController/cancelImage");

        parent::cancel($key);
    }



    public function saveCategory() {  

		$model = $this->getModel('AddNewCategory');

        $data  = Factory::getApplication()->input->post->get('formArray', array(), 'array');
		$form = $model->getForm($data, false);
        
		// $validData = $model->validate($form, $data);

		if($model->save($data)){
			$app->enqueueMessage("Category Added Successfully");
			$this->setRedirect(Route::_('index.php?&task=Display.display', false));
		}
		else{
			$app->enqueueMessage("Could not add category");
			$this->setRedirect(Route::_('index.php?&task=Display.addNewCategory', false));
		}
			
    }

}