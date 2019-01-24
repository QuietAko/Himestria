var HTTP_HOST = "http://" + location.hostname + "/study/";

var typeId = document.getElementById("typeId").value;
var problemId;

var questionBlock = document.getElementById("question");
var answerInput = document.getElementById("answer");
var checkButton = document.getElementById("check");
var messageSpan = document.getElementById("message");

answerInput.addEventListener("keydown", validateNumber);

nextProblem();

function reset() {
    questionBlock.innerHTML = "...";    
    answerInput.disabled = true;
    answerInput.value = "";
    checkButton.disabled = true;

    resetOnInput();
    
    checkButton.removeEventListener("mousedown", nextProblem);
    checkButton.addEventListener("mousedown", checkAnswer);    
}

function resetOnInput() {
    checkButton.value = "Проверить ответ";
    checkButton.className = 'grey';

    messageSpan.innerHTML = '';
    messageSpan.style.display = 'none';
}

function nextProblem() {

    reset();

    showMessage("Загрузка...");

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response["result"] === "success") {
                problemId = response["id"];
                questionBlock.innerHTML = response["question"];
                answerInput.disabled = false;
                checkButton.disabled = false;                
                messageSpan.style.display = "none";
            }
            else {
                showMessage(response["result"]);
            }
        }
    };

    xhttp.open("GET", HTTP_HOST + "ajax/get_task_item_question.php?word_problem&type_id=" + typeId);
    xhttp.send();
}

function checkAnswer() {

    if (!isEmpty(answerInput.value)) {

        answerInput.disabled = true;
        checkButton.disabled = true;
        checkButton.value = "Проверить ответ";
        checkButton.className = "grey";
        showMessage("Проверка...");

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = JSON.parse(this.responseText);

                if (response["result"] === "success") {

                    if (response["correct"]) {
                        onCorrectAnswer();
                    }
                    else {
                        onIncorrectAnswer();
                    }

                    checkButton.disabled = false;
                    messageSpan.style.display = "none";
                }
                else {
                    showMessage(response["result"]);
                }
            }
        };

        var answerValue = Number(answerInput.value.replace(",", "."));

        xhttp.open("GET", HTTP_HOST + "ajax/check_task_answer.php?word_problem&id=" + problemId + "&answer=" + answerValue);
        xhttp.send();        
    }
    else {
        showMessage("Введите ответ в поле.");
    }    
}

function onCorrectAnswer() {
    checkButton.value = "Правильно! Следующая задача";
    checkButton.className = "green";
    checkButton.removeEventListener("mousedown", checkAnswer);
    checkButton.addEventListener("mousedown", nextProblem);
}

function onIncorrectAnswer() {
    answerInput.disabled = false;
    checkButton.value = "Неправильно! Попробуйте еще раз";
    checkButton.className = "red";  
}

function showMessage(msg) {
    messageSpan.innerHTML = msg;
    messageSpan.style.display = "inline";
}

function isEmpty(str) {
    str = str.trim();
    return (str.length === 0);
}

function validateNumber(evt) {
    var e = evt || window.event;
    var key = e.keyCode || e.which;

    if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
        // numbers   
        key >= 48 && key <= 57 ||
        // Numeric keypad
        key >= 96 && key <= 105 ||
        // comma, period (also numpad)
        key == 188 || key == 190 || key == 110 ||
        // Backspace and Tab and Enter
        key == 8 || key == 9 ||
        // Home and End
        key == 35 || key == 36 ||
        // left and right arrows
        key == 37 || key == 39 ||
        // Del and Ins
        key == 46 || key == 45) {
        // input is VALID

        resetOnInput();
    }
    //Enter
    else if (key == 13) {
        checkAnswer();
    }
    else {
        // input is INVALID
        e.returnValue = false;

        if (e.preventDefault) {
            e.preventDefault();
        }
    }
}