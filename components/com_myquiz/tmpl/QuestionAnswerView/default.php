<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

$document = Factory::getDocument();
$document->addStyleSheet("media/com_myquiz/css/style.css");
$document->addScript("media/com_myquiz/js/questionAnswerView.js");
?>

<!-- Header -->
<div class="row">
	<div class="col">
		<a class="btn" href="<?php echo Uri::getInstance()->current(); ?>">Back</a>
	</div>
	<div class="col-8 text-center">
		<h3><?php echo $this->title; ?></h3>
	</div>
	<div class="col">
        <button id="finish-button" class="btn float-end">Finish</button>
    </div>
</div>

<hr/>

<!-- Previous Button | Questions | Next Button -->
<div class="row ">
    <div class="col mt-2">
        <button
            id="previous-button"
            class="btn float-end"
            <?php if ($this->questionNumber == 1) echo "disabled"; ?>
        >Previous</button>
    </div>

    <div class="col-auto w-75">
        <?php foreach ($this->questions as $question) : ?>
            <?php if ($this->questionNumber == $question->questionNumber) : ?>
                <button class="btn mt-2" disabled><?php echo $question->questionNumber; ?></button>
            <?php else : ?>
                <button class="btn mt-2" name="questionButtons"><?php echo $question->questionNumber; ?></button>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
    <div class="col mt-2">
        <?php if ($this->questionNumber != $this->count): ?>
            <button
                id="next-button"
                class="btn">Next</button>
        <?php endif ?>
    </div>
</div>

<hr/>

<!-- Question and Answers -->
<div class="row">
    <div class="col-5">
        <img id="<?php echo $this->imageId; ?>" src="<?php echo $this->imageUrl; ?>" />
    </div>
    <div class="col-7">
        <form action="" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
            <input type="hidden" name="questionNumber" value="<?php echo $this->questionNumber ?>"/>
            <input type="hidden" name="quizId" value="<?php echo $this->quizId ?>"/>
            <input type="hidden" name="count" value="<?php echo $this->count ?>"/>
            
            <h5><?php echo $this->question; ?></h5>

            <?php foreach ($this->items as $row) : ?>
                <div class="row mt-3">
                    <div class="col-auto">
                        <input type="radio" name="selectedAnswer" value="<?php echo $row->answerNumber ?>"/>
                    </div>
                    <div class="col"><?php echo $row->answerDescription ?></div>
                </div>
            <?php endforeach; ?>
        </form>
    </div>    
</div>


<!-- Focused viewer -->
<div id="focused-img-view" class="overlay-background d-none">
    <div class="h-100 text-center">
        <img id="focused-img" class="h-100" src="<?php echo $this->imageUrl; ?>"/>
    </div>
    <div id="controls-container" class="row fixed-top m-2">
        <div class="col"></div>

        <div id="controls" class="col-auto rounded">
            <div class="row">
                <div class="col rounded px-4 text-center">
                    <label for="brightness-input">Brightness</label>
                    <input type="range" min="50" max="250" id="brightness-input" class="form-range"/>
                </div>
                <div class="col-auto rounded mx-2 text-center">
                    Scroll to <br/> Zoom
                </div>
                <div class="col rounded px-4 text-center">
                    <label for="contrast-input">Contrast</label>
                    <input type="range" min="50" max="450" id="contrast-input" class="form-range"/>
                </div>
            </div>
        </div>

        <div class="col">
            <button id="exit-button" class="btn float-end rounded-circle"><i class="icon-times icon-white"></i></button>
        </div>
    </div>
</div>


<script>
    window.onload = function() {
        checkAnswered();

        function checkAnswered() {
            let button = Array.from(document.getElementsByName("selectedAnswer"));
            
            if ("<?php echo $this->answerNumber; ?>") {
                for(let i = 0; i < button.length; i++) {
                    if(button[i].value == "<?php echo $this->answerNumber; ?>") {
                        button[i].checked = true;
                    }
                }
            }
        }

        const previousButton = document.getElementById("previous-button");
        const nextButton = document.getElementById("next-button");
        const finishButton = document.getElementById("finish-button");
        const form = document.getElementById("adminForm");

        const questionButtons = Array.from(document.getElementsByName("questionButtons"));

        questionButtons.forEach(button => {
            button.onclick = () => {
                var questionNum = parseInt(button.innerText);
                form.action = `?&question=${questionNum}&task=Answer.anyQuestion`;
                form.submit();
            }
        });

        previousButton.onclick = () => {
            submitForm("prevQuestion");
        }

        if(nextButton) {
            nextButton.onclick = () => {
            submitForm("nextQuestion");
            }
        }

        finishButton.onclick = () => {
            submitForm("saveData");
        }

        function submitForm(action) {
            form.action = `?task=Answer.${action}`;
            form.submit();
        }


        const focusedImageView = document.getElementById("focused-img-view");
        const focusedImage = document.getElementById("focused-img");
        const contrastInput = document.getElementById("contrast-input");
        const brightnessInput = document.getElementById("brightness-input");

        const minZoom = 0.5;
        const maxZoom = 2.5;
        const zoomFactor = 0.1;
        
        let currentZoom = 0.5;
        let currentBrightness = 100;
        let currentContrast = 100;

        document.getElementById(<?php echo $this->imageId; ?>).onclick = () => {
            focusedImageView.classList.remove("d-none");
        }

        document.getElementById("exit-button").onclick = () => {
            focusedImageView.classList.add("d-none");
            focusedImage.style.filter = "";
        }

        focusedImage.style.transform = `scale(0.5)`;
        focusedImage.addEventListener("wheel", function (e) {
            e.preventDefault();

            if (e.deltaY < 0) {
                if (currentZoom >= maxZoom) return;
                currentZoom += zoomFactor;
            } else {
                if (currentZoom <= minZoom) return;
                currentZoom -= zoomFactor;
            }

            const { left, top, width, height } = focusedImage.getBoundingClientRect();
            const imageX = ((e.clientX - left) / width) * 100;
            const imageY = ((e.clientY - top) / height) * 100;
            focusedImage.style.transformOrigin = `${imageX}% ${imageY}%`;
            focusedImage.style.transform = `scale(${currentZoom})`;
        });

        brightnessInput.value = currentBrightness;
        brightnessInput.addEventListener("input", function() {
            currentBrightness = this.value;
            focusedImage.style.filter = `brightness(${currentBrightness}%) contrast(${currentContrast}%)`;
        });

        contrastInput.value = currentContrast;
        contrastInput.addEventListener("input", function() {
            currentContrast = this.value;
            focusedImage.style.filter = `brightness(${currentBrightness}%) contrast(${currentContrast}%)`;
        });

    };
</script>

