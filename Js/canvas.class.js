var Canvas = (function() {
    
    var DEFAULT_COLOR = "#21242C";
    var SELECTED_COLOR = "#F73434";

    var CANVAS_MIN_WIDTH = 785;
    var CANVAS_MAX_WIDTH = 1024;
    var CANVAS_MIN_HEIGHT = 760;
    var CANVAS_MAX_HEIGHT = 768;

    var OFFSET = 20;    
    var RECT_WIDTH = 350;
    var RECT_HEIGHT = 150;
    var HALF_RECT_WIDTH = (RECT_WIDTH - OFFSET) / 2;
    var HALF_RECT_HEIGHT = (RECT_HEIGHT - OFFSET) / 2;    

    var FONT_NAME = "Georgia";
    var FONT_SIZE = 40;
    var FONT_UNIT = "px";
    var LEFT_ALIGN = "left";
    var CENTER_ALIGN = "center";
    var MIDDLE_ALIGN = "middle";    
    //var BREAK_SYMBOL = "[BR]";
    var CHARS_WIDTH_RATIO = 23 / 492;

    var canvas = document.getElementById("myCanvas");
    setCanvasSize();
    canvas.addEventListener("mousedown", mouseDownListener);
	canvas.addEventListener("mousemove", mouseMoveListener);

    var context = canvas.getContext("2d");
    context.font = FONT_SIZE.toString() + FONT_UNIT + " " + FONT_NAME;
	context.textBaseline = MIDDLE_ALIGN;

    var TEXT_HEIGHT = FONT_SIZE + 10;
    var TEXT_WIDTH = canvas.width - OFFSET * 2;
    var BOTTOM_TEXT_Y = canvas.height - OFFSET - TEXT_HEIGHT;

    var ANSWER_RECT_WIDTH = 260;   

    var correctRect = new Rect(OFFSET, BOTTOM_TEXT_Y, 280, TEXT_HEIGHT, "Правильно: 0", LEFT_ALIGN);

    var QUESTION_NUMBER_RECT_WIDTH = 311;
    var questionNumberRect = new Rect(canvas.width - OFFSET - QUESTION_NUMBER_RECT_WIDTH, BOTTOM_TEXT_Y, QUESTION_NUMBER_RECT_WIDTH, TEXT_HEIGHT, "", LEFT_ALIGN);

    var resultCorrectRect = new Rect(OFFSET, canvas.height / 2 - TEXT_HEIGHT / 2, TEXT_WIDTH, TEXT_HEIGHT, "", CENTER_ALIGN);

    var TRY_AGAIN_RECT_WIDTH = 440;
    var TRY_AGAIN_RECT_HEIGHT = 100;
    var tryAgainRect = new Rect((canvas.width - TRY_AGAIN_RECT_WIDTH) / 2, resultCorrectRect.getY() + resultCorrectRect.getHeight() + 2 * OFFSET, TRY_AGAIN_RECT_WIDTH, TRY_AGAIN_RECT_HEIGHT, "Попробовать еще раз", CENTER_ALIGN);

    var taskRect, questionRect, answerRect, variantRects;
    var selectedRectIndex = -1;    

    var TASK_MODE = 0;
    var RESULT_MODE = 1;
    var mode;

    function setCanvasSize() {

        if (document.body.clientWidth > CANVAS_MAX_WIDTH) {
            canvas.width = CANVAS_MAX_WIDTH;
        }
        else if (document.body.clientWidth < CANVAS_MIN_WIDTH) {
            canvas.width = CANVAS_MIN_WIDTH;
        }
        else {
            canvas.width = document.body.clientWidth;
        }

        if (document.body.clientHeight > CANVAS_MAX_HEIGHT) {
            canvas.height = CANVAS_MAX_HEIGHT;
        }
        else if (document.body.clientHeight < CANVAS_MIN_HEIGHT) {
            canvas.height = CANVAS_MIN_HEIGHT;
        }
        else {
            canvas.height = document.body.clientHeight;
        }
    }

    function makeRects(taskLabel, variantLabels) {        

        makeTaskRect(taskLabel);        
        makeQuestionRect(taskLabel.length > 0);
        makeAnswerRect(taskLabel.length > 0);
        makeVariantRects(variantLabels);        
    }

    function makeTaskRect(taskLabel) {

        if (taskLabel.length > 0) {

            var maxChars = Canvas.getMaxChars(TEXT_WIDTH);            
            var lines = Math.ceil(taskLabel.length / maxChars);

            taskRect = new Rect(OFFSET, OFFSET, TEXT_WIDTH, TEXT_HEIGHT * lines, taskLabel, LEFT_ALIGN);
        }
        else {
            taskRect = new Rect(0, 0, 0, 0, "", LEFT_ALIGN);
        }
    }

    function makeQuestionRect(topOffset) {

        var rectX = OFFSET;
        var rectY = taskRect.getY();
        var width = TEXT_WIDTH;
        var height = TEXT_HEIGHT;
        var align;

        if (topOffset) {
            rectX += ANSWER_RECT_WIDTH;
            rectY += taskRect.getHeight() + 2 * OFFSET;
            width -= ANSWER_RECT_WIDTH * 2;
            align = CENTER_ALIGN;
        }
        else {
            rectY += OFFSET;
            height *= 4;
            align = LEFT_ALIGN;
        }

        questionRect = new Rect(rectX, rectY, width, height, "", align);
    }

    function makeAnswerRect(topOffset) {

        var rectY = questionRect.getY();

        if (!topOffset) {
            rectY += questionRect.getHeight() + OFFSET;
        }

        answerRect = new Rect(OFFSET, rectY, ANSWER_RECT_WIDTH, TEXT_HEIGHT, "", LEFT_ALIGN);
    }

    function makeVariantRects(variantLabels) {

        variantRects = [];
        
        var rectY1 = answerRect.getY() + answerRect.getHeight() + 3 * OFFSET;
        var rectX1 = OFFSET;        

        if (variantLabels.length <= 4) {  

            var rectY2 = rectY1 + RECT_HEIGHT + OFFSET;	
            var rectX2 = canvas.width - OFFSET - RECT_WIDTH;

            if (variantLabels.length > 0) {
                variantRects.push(new Rect(rectX1, rectY1, RECT_WIDTH, RECT_HEIGHT, variantLabels[0], CENTER_ALIGN));
            }

            if (variantLabels.length > 1) {
                variantRects.push(new Rect(rectX1, rectY2, RECT_WIDTH, RECT_HEIGHT, variantLabels[1], CENTER_ALIGN));
            }	

            if (variantLabels.length > 2) {
                variantRects.push(new Rect(rectX2, rectY1, RECT_WIDTH, RECT_HEIGHT, variantLabels[2], CENTER_ALIGN));
            }

            if (variantLabels.length > 3) {
                variantRects.push(new Rect(rectX2, rectY2, RECT_WIDTH, RECT_HEIGHT, variantLabels[3], CENTER_ALIGN));
            }
        }
        else if (variantLabels.length <= 10) {            

            var rectX2 = rectX1 + HALF_RECT_WIDTH + OFFSET;
            var rectY2 = rectY1 + HALF_RECT_HEIGHT + OFFSET;
            var rectY3 = rectY2 + HALF_RECT_HEIGHT + OFFSET;

            var rectX3 = canvas.width - HALF_RECT_WIDTH * 2 - OFFSET * 2;
            var rectX4 = rectX3 + HALF_RECT_WIDTH + OFFSET;

            if (variantLabels.length > 0) {
                variantRects.push(new Rect(rectX1, rectY1, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[0], CENTER_ALIGN));
            }

            if (variantLabels.length > 1) {
                variantRects.push(new Rect(rectX2, rectY1, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[1], CENTER_ALIGN));
            }

            if (variantLabels.length > 2) {
                variantRects.push(new Rect(rectX1, rectY2, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[2], CENTER_ALIGN));
            }

            if (variantLabels.length > 3) {
                variantRects.push(new Rect(rectX2, rectY2, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[3], CENTER_ALIGN));
            }

            if (variantLabels.length > 4) {
                variantRects.push(new Rect(rectX1, rectY3, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[4], CENTER_ALIGN));
            }

            if (variantLabels.length > 5) {
                variantRects.push(new Rect(rectX3, rectY1, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[5], CENTER_ALIGN));
            }

            if (variantLabels.length > 6) {
                variantRects.push(new Rect(rectX4, rectY1, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[6], CENTER_ALIGN));
            }

            if (variantLabels.length > 7) {
                variantRects.push(new Rect(rectX3, rectY2, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[7], CENTER_ALIGN));
            }

            if (variantLabels.length > 8) {
                variantRects.push(new Rect(rectX4, rectY2, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[8], CENTER_ALIGN));
            }

            if (variantLabels.length > 9) {
                variantRects.push(new Rect(rectX3, rectY3, HALF_RECT_WIDTH, HALF_RECT_HEIGHT, variantLabels[9], CENTER_ALIGN));
            }
        }
    }

    function resetScreenOnTask() {

        clearAll();	

        drawRects(variantRects);	

        taskRect.addText();
        correctRect.addText();
        //questionNumberRect.addText();
    }

    function clearAll() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    function drawRects(rects) {	

        for (var i = 0; i < rects.length; i++) {
            rects[i].stroke();
        }
    }        

    function mouseDownListener(evt) {	

        //code below prevents the mouse down from having an effect on the main browser window:
        if (evt.preventDefault) {
            evt.preventDefault();
        } //standard
        else if (evt.returnValue) {
            evt.returnValue = false;
        } //older IE

        var mousePoint = getMousePosition(evt);

        if (mode === TASK_MODE) {
            var rectOnMousePosition = Rect.getRectOnPoint(variantRects, mousePoint);

            if (rectOnMousePosition !== -1) {

                if (selectedRectIndex >= 0 && selectedRectIndex < variantRects.length) {
                    variantRects[selectedRectIndex].stroke();
                }

                selectedRectIndex = rectOnMousePosition;			

                Manager.checkAnswer(selectedRectIndex);
            }
        }
        else if (mode === RESULT_MODE) {
            if (tryAgainRect.containsPoint(mousePoint)) {
                Manager.tryAgain();
            }
        }	

        return false;
    }

    function mouseMoveListener(evt) {

        if (evt.preventDefault) {
            evt.preventDefault();
        } //standard
        else if (evt.returnValue) {
            evt.returnValue = false;
        } //older IE

        var mousePoint = getMousePosition(evt);

        var cursorStyle = 'default';

        if (mode === TASK_MODE) {
            var rectOnMousePosition = Rect.getRectOnPoint(variantRects, mousePoint);

            if (rectOnMousePosition !== -1) {
                cursorStyle = 'pointer';
            }
        }
        else if (mode === RESULT_MODE) {
            if (tryAgainRect.containsPoint(mousePoint)) {
                cursorStyle = 'pointer';
            }
        }

        if (canvas.style.cursor !== cursorStyle) {
            canvas.style.cursor = cursorStyle;
        }

        return false;
    }

    function getMousePosition(evt) {
        //getting mouse position correctly, being mindful of resizing that may have occured in the browser:
        var boundsRect = canvas.getBoundingClientRect();
        var mouseX = (evt.clientX - boundsRect.left) * (canvas.width / boundsRect.width);
        var mouseY = (evt.clientY - boundsRect.top) * (canvas.height / boundsRect.height);
        var mousePoint = {x: mouseX, y: mouseY};
        return mousePoint;
    }

    return {

        getContext: function() {
            return context;
        },

        getTextHeight: function() {
            return TEXT_HEIGHT;
        },

        getCenterAlign: function() {
            return CENTER_ALIGN;
        },

        getDefaultColor: function() {
            return DEFAULT_COLOR;
        },

        getMaxChars: function(width) {
            return Math.round(width * CHARS_WIDTH_RATIO);
        },

        showTask: function(taskLabel, variantLabels) {
            makeRects(taskLabel, variantLabels);
            resetScreenOnTask();
        },

        showQuestion: function(questionLabel, questionNumber, questionsCount) {

            questionRect.resetText(questionLabel);            
            questionNumberRect.resetText("Задача " + questionNumber.toString() + " из "  + questionsCount.toString());
        
            if (selectedRectIndex >= 0 && selectedRectIndex < variantRects.length) {
                variantRects[selectedRectIndex].stroke();
                selectedRectIndex = -1;
            }

            answerRect.resetText();

            mode = TASK_MODE;
        },

        showResult: function(correctCount, questionsCount) {
            clearAll();        

            resultCorrectRect.resetText("Правильно: " + correctCount.toString() + " из " + questionsCount.toString());

            tryAgainRect.stroke();

            mode = RESULT_MODE;
        },        

        onCorrectAnswer: function(correctCount) {
            correctRect.resetText("Правильно: " + correctCount.toString());
        },

        onInCorrectAnswer: function(selectedAnswer) {
            if (selectedAnswer >= 0 && selectedAnswer < variantRects.length) {
                variantRects[selectedAnswer].stroke(SELECTED_COLOR);
            }

            answerRect.resetText("неправильно!", SELECTED_COLOR);
        }
    };    

})();