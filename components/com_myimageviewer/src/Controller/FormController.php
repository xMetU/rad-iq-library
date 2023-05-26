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
		$model = $this->getModel('ImageForm');
		
		$data = Factory::getApplication()->input->post->getArray();
		$file = Factory::getApplication()->input->files->get('imageUrl');
		
		$name = $file['name'];
		$tmp = $file['tmp_name'];
		$categoryName = $model->getCategory($data['categoryId'])->categoryName;

		$path = JPATH_ROOT . '/media/com_myImageViewer/images/';
		$folderUrl = $path . $categoryName;
		$uploadUrl = $path . $categoryName . '/' . $name;
		$imageUrl = 'media/com_myImageViewer/images/' . $categoryName . '/' . $name;

		Folder::create($folderUrl);
		File::upload($tmp, $uploadUrl);

		array_push($data, $imageUrl);

		$model->saveImage($data);
        $this->setRedirect(Route::_(
			Uri::getInstance()->current() . '?task=Display.imageForm',
			false,
		));
    }

	public function updateImage() {
		$model = $this->getModel('ImageForm');

		$data = Factory::getApplication()->input->getArray();

		$model->updateImage($data);
		
		$this->setRedirect(Route::_(
			Uri::getInstance()->current() . '?task=Display.imageDetails&id=' . $data['imageId'],
			false,
		));
	}

	public function deleteImage() {
		$model = $this->getModel('ImageDetails');

		$data = Factory::getApplication()->input->getArray();
		
		// Error messages handled by ImageFormModel.deleteImage
		if ($model->deleteImage($data['imageId'])) {
			if (File::exists($data['imageUrl'])) {
				File::delete($data['imageUrl']);
			}
		}

		$this->setRedirect(Route::_(
			Uri::getInstance()->current(),
			false,
		));
	}

    public function saveCategory() {
		$model = $this->getModel('CategoryForm');
		
		$categoryName = Factory::getApplication()->input->getVar('categoryName');

		$model->saveCategory($categoryName);

		$this->setRedirect(Route::_(
			Uri::getInstance()->current() . '?task=Display.categoryForm',
			false,
		));
    }

	public function deleteCategory() {
		$model = $this->getModel('CategoryForm');
		
		$categoryId = Factory::getApplication()->input->getVar('categoryId');

		$model->deleteCategory($categoryId);

		$this->setRedirect(Route::_(
			Uri::getInstance()->current() . '?task=Display.categoryForm',
			false,
		));
	}

	public function toggleIsHidden() {
		$model = $this->getModel('ImageDetails');

		$imageId = Factory::getApplication()->input->getVar('id');

		$model->toggleIsHidden($imageId);

		$this->setRedirect(Route::_(
			Uri::getInstance()->current(),
			false,
		));
	}

}