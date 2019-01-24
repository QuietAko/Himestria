var Manager = (function() {
    
    var QUESTIONS_COUNT = parseInt(document.getElementById("questionsCount").value);

    var tasks = [], tasksToGive = [];
    var currentTaskIndex = -1;
    var loadTaskIndex = -1;

    var questionNumber = 0;
    var correctCount = 0;
    var checked = false;

    function loadNextTask() {

        loadTaskIndex++;

        if (loadTaskIndex < tasksToGive.length) {
            var taskTypeId = parseInt(tasksToGive[loadTaskIndex]);
            tasks.push(new Task(taskTypeId, loadNextTask));
        }
        else {
            goToNextTask();
        }
    }

    function goToNextTask() {        

        if (tasks.length > 0 && questionNumber < QUESTIONS_COUNT) {            
        
            var nextTaskIndex = currentTaskIndex;

            if (tasks.length == 1) {
                nextTaskIndex = 0;
            }
            else {
                while (nextTaskIndex === currentTaskIndex) {
                    nextTaskIndex = MyMath.getRandomInt(0, tasks.length - 1);
                }
            }

            if (nextTaskIndex !== currentTaskIndex) {
                Canvas.showTask(tasks[nextTaskIndex].getTaskLabel(), tasks[nextTaskIndex].getVariantLabels());                
            }

            currentTaskIndex = nextTaskIndex;

            tasks[currentTaskIndex].getNextQuestion(showNextQuestion);
        }
        else {
            Canvas.showResult(correctCount, QUESTIONS_COUNT);
        }        
    }

    function showNextQuestion(nextQuestion)
    {
        questionNumber++;
        checked = false;

        Canvas.showQuestion(nextQuestion, questionNumber, QUESTIONS_COUNT);
    }

    function onCorrectAnswer()
    {
        if (!checked) {
            correctCount++;
        }

        Canvas.onCorrectAnswer(correctCount);
        goToNextTask();
    }

    function onInCorrectAnswer(selectedAnswer)
    {
        Canvas.onInCorrectAnswer(selectedAnswer);
        checked = true;
    }

    return {
        run: function() {
            tasksToGive = document.getElementById("typeId").value.split(',');
            loadNextTask();            
        },

        checkAnswer: function(selectedAnswer) {

            tasks[currentTaskIndex].checkAnswer(selectedAnswer, onCorrectAnswer, onInCorrectAnswer);
        },

        tryAgain: function() {
            location.reload();
        }
    };

})();

Manager.run();