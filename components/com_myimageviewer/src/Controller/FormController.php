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
const PATH = JPATH_ROOT . '/media/com_myImageViewer/images/';

class FormController extends BaseController {
	
	public function saveImage() {
		$model = $this->getModel('ImageForm');
		
		$data = Factory::getApplication()->input->post->getArray();
		$file = Factory::getApplication()->input->files->get('imageUrl');

		// Create the category folder
		$categoryName = $model->getCategory($data['categoryId'])->categoryName;
		$folderUrl = PATH . $categoryName;
		Folder::create($folderUrl);

		// Save the file
		$name = $data["imageName"] . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
		$tmp = $file['tmp_name'];

		$uploadUrl = PATH . $categoryName . '/' . $name;
		$imageUrl = 'media/com_myImageViewer/images/' . $categoryName . '/' . $name;

		array_push($data, $imageUrl);
		if ($model->saveImage($data)) {
			File::upload($tmp, $uploadUrl);
		}
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
		$folderUrl = PATH . $model->getCategoryName($data['imageId']);
		if ($model->deleteImage($data['imageId'])) {
			if (File::exists($data['imageUrl'])) {
				File::delete($data['imageUrl']);

				if (count(Folder::files($folderUrl)) == 0) {
					Folder::delete($folderUrl);
				}
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