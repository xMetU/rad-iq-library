<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_myQuiz
 *
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;


// Consolidate from multiple items to a single variable
foreach ($this->items as $i => $row){
    $quizId = $row->quizId;
    $title = $row->title;
    $questionNumber = $row->questionNumber;
    $question = $row->questionDescription;
    $imageId = $row->imageId;
    $imageUrl = $row->imageUrl;
}


$count = count($this->questions);

// Update the button if at end of quiz
if($questionNumber < $count){
    $label = Text::_('NEXT'); 
}
else {
    $label = Text::_('FINISH'); 
}

$answerNumber = 0;

$userQuestionData = Factory::getApplication()->getUserState('myQuiz.userQuestionData');
foreach ($userQuestionData as $data){
    if(isset($data['questionNumber'])) {
        if($data['questionNumber'] === $questionNumber) {
            $answerNumber = $data['answerNumber'];
        }
        
    }
}

?>


<!-- ====== QUESTION DISPLAY WITH ANSWER LIST =========== -->

<div class="mt-5">

    <!-- ====== TITLES =========== -->
    <div class="row">
        <div><h3><?php echo $title; ?></h3></div>
    </div>


    <!-- ====== BODY =========== -->
    <div class="row mt-5">

        <!-- ====== Image =========== -->
        <div class="col-3">							
            <img id="<?php echo $imageId; ?>" src="<?php echo $imageUrl; ?>" style="width:250px;height:280px;"/>
        </div>


        <!-- ====== ANSWERS =========== -->
        <div class="col-6">
            <form action="" method="post" id="adminForm" name="adminForm" enctype="multipart/form-data">
                
                <!--===== Question Part ====== -->
                <div><h3><?php echo 'Q' . $questionNumber . '. ' . $question; ?></h3></div>

                <!--===== Answer Part ====== -->
                <div class="mt-5 mb-5">
                    <?php foreach ($this->items as $i => $row) : ?>
                        <div class="row mt-3">
                            <div class="col-1">
                                <input type="radio" name="selectedAnswer" value="<?php echo $row->answerNumber ?>"/>
                            </div>
                            <div class="col-1"><?php echo $row->answerNumber . '.' ?></div>
                            <div class="col-10"><?php echo $row->answerDescription ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!--========= [PREV, NEXT] BUTTONS =======================-->
                <div class="row mt-5">            
                    
                    <input type="hidden" name="questionNumber" value="<?php echo $questionNumber ?>"/>
                    <input type="hidden" name="quizId" value="<?php echo $quizId ?>"/>
                    <input type="hidden" name="count" value="<?php echo $count ?>"/>
                    
                    <div class="col-2">  
                        <?php if($questionNumber > 1): ?> 
                            <input type="button" class="btn btn-primary" id="prev" value="<?php echo Text::_(' PREV'); ?>"/>                            
                        <?php endif ?>
                    </div>
                    <div class="col-2">  
                        <input type="button" class="btn btn-primary" id="next" value="<?php echo $label; ?>" />
                    </div>                      
                </div>
            </form>
        </div>

        <!-- ====== Question List =========== -->
        <div class="col-3">
            <?php foreach ($this->questions as $q => $row) : ?>
                <div class="row mt-5 col-5">
                    <a class="btn btn-outline-primary" href="<?php echo Uri::getInstance()->current() . Route::_('?&id=' . $row->id . '&question='. $row->questionNumber . '&count='. $count . '&task=Display.questionDisplay') ?>"><?php echo Text::_("Question ") . $row->questionNumber; ?></a>
                </div>
            <?php endforeach; ?> 
        </div>

    </div>            
</div>



<!-- ===== Submits Form onClick next/prev buttons ==-->
<script>
    window.onload = function() {

        activateButtons();
        checkAnswered();



        function activateButtons() {
            let next = document.getElementById("next");
            let prev = document.getElementById("prev");
        
            let text = next.value;
            console.log(text);

            next.addEventListener("click", function() {  
                var nextAction = 'nextQuestion';
                var finishAction = 'saveData';

                if(next.value == 'NEXT'){
                    console.log("next");
                    changeQuestion(nextAction);
                }
                if(next.value == 'FINISH'){
                    changeQuestion(finishAction);
                }
            });

            // Check prev button is not null (1st question doesn't need prev button)
            if(prev) {
                prev.addEventListener("click", function () {       
                    var action = 'prevQuestion';
                    changeQuestion(action);
                });
            }
        }

        function checkAnswered() {
            let button = Array.from(document.getElementsByName("selectedAnswer"));
            
            if("<?php echo $answerNumber; ?>") {
                for(let i = 0; i < button.length; i++) {
                    if(button[i].value == "<?php echo $answerNumber; ?>") {
                        console.log("answered");
                        button[i].checked = true;
                    }
                }
            }
        }

        function changeQuestion(formAction){
            let form = document.getElementById("adminForm");

            form.action = '<?php echo Uri::getInstance()->current() . '?&task=Answer.' ; ?>' + formAction;
            form.submit();
        }
    };
</script>

