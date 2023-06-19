<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;

$document = Factory::getDocument();
$document->addStyleSheet("media/com_myquiz/css/style.css");
?>


<div>
    <div class="row mt-5 bg-info">
        <h2 class="text-center text-white">Are you sure you want to reset all attempts at this quiz?</h2>
        <h3 class="text-center text-white">This will delete all previous attempts at this quiz.</br>This action cannot be undone</h3>
    </div>
    

    <form 
        action="<?php echo Uri::getInstance()->current() . '?&option=com_myQuiz&task=Display.resetAttempts'; ?>"
        method="post"
        enctype="multipart/form-data">

        <input type="hidden" name="userId" value="<?php echo $this->userId; ?>"/>
        <input type="hidden" name="quizId" value="<?php echo $this->quizId; ?>"/>

        <div class="row mt-5 m-auto text-center">
                <div class="col">
                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                </div>

                <div class="col">
                    <a class="btn btn-outline-primary" href="<?php echo Uri::getInstance()->current() 
                                        . '?&option=com_myQuiz&task=Display.display'; ?>"
                    >No</a>
                </div>
        </div>
        
    </form>
</div>







