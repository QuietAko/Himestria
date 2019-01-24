function Task(typeIdNew, onInitialize) {

    var HTTP_HOST = "http://" + location.hostname + "/ajax";

    var typeId = typeIdNew;
    var taskLabel = "", variantLabels = [];

    var usedQuestions = [];
    var questionId = -1;

    initialize();

    function initialize() {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {                
                var response = JSON.parse(this.responseText);
                if (response["result"] === "success") {
                    taskLabel = response["question"];

                    if (5 <= typeId && typeId <= 14) {
                        for (var i = 0; i <= 8; i++) {
                            variantLabels.push(i.toString());
                        }
                    }
                    else if (typeId == 15) {
                        variantLabels = ["Да", "Нет"];
                    }
                    else {
                        variantLabels = response["variants"];
                    }

                    onInitialize();
                }
                else {
                    alert(response["result"]);
                }
            }
        };
        console.log(1)
        xhttp.open("GET", HTTP_HOST + "/get_test_task.php?type_id=" + typeId);
        xhttp.send();
    }

    function modifyFormula(formula) {

        var result = "";

        for (var j = 0; j < formula.length; j++) {

            var char = formula.charAt(j);
            var charInt = parseInt(char, 10);

            if (!isNaN(charInt)) {
                result += String.fromCharCode(8320 + charInt);
            }
            else {
                result += char;
            }
        }

        return result;
    }

    this.getTaskLabel = function() {
        return taskLabel;
    }

    this.getVariantLabels = function() {
        return variantLabels;
    }

    this.getNextQuestion = function(showNextQuestion) {

        usedQuestions[questionId] = true;

        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {                
                var response = JSON.parse(this.responseText);
                if (response["result"] === "success") {
                    
                    questionId = response["id"];
                    var question = response["question"];

                    if (typeId != 15) {
                        question = modifyFormula(question);
                    }

                    showNextQuestion(question);
                }
                else {
                    alert(response["result"]);
                }
            }
        };

        var usedQuestionsQuery = ""; 
        
        for (var key in usedQuestions) {
            if (usedQuestions.hasOwnProperty(key)) {
                usedQuestionsQuery += "&uq[" + key + "]";
            }            
        }

        xhttp.open("GET", HTTP_HOST + "/get_task_item_question.php?type_id=" + typeId + usedQuestionsQuery);
        xhttp.send();
    }      

    this.checkAnswer = function(selectedAnswer, onCorrectAnswer, onInCorrectAnswer) {

        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = JSON.parse(this.responseText);

                if (response["result"] === "success") {

                    if (response["correct"]) {
                        onCorrectAnswer();
                    }
                    else {
                        onInCorrectAnswer(selectedAnswer);
                    }                    
                }
                else {
                    alert(response["result"]);
                }
            }
        };

        xhttp.open("GET", HTTP_HOST + "/check_task_answer.php?id=" + questionId + "&answer=" + selectedAnswer);
        xhttp.send();
    }
}