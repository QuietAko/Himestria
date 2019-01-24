function Rect(xNew, yNew, widthNew, heightNew, labelNew, alignNew) {    

    var x = xNew;
    var y = yNew;
    var width = widthNew;
    var height = heightNew;
    var label = labelNew;
    var align = alignNew;    

    function clear() {
        Canvas.getContext().clearRect(x - 1, y - 1, width + 2, height + 2);
    }

    // function getLabelLines() {

    //     var lines = [];

    //     var leftLabel = label;
    //     var breakIndex = -1;
    //     var breakSymbol = Canvas.getBreakSymbol();              

    //     do {
    //         if (breakIndex !== -1) {
    //             leftLabel = leftLabel.substring(breakIndex + breakSymbol.length);
    //         }

    //         breakIndex = leftLabel.indexOf(breakSymbol);

    //         var end = (breakIndex === -1) ? leftLabel.length : breakIndex;
    //         var line = leftLabel.substring(0, end);

    //         lines.push(line);        
    //     }
    //     while (breakIndex !== -1);

    //     return lines;
    // }

    function getLabelLines() {
        
        var lines = [];

        var maxChars = Canvas.getMaxChars(width);

        if (label.length <= maxChars) {
            lines.push(label);
        }
        else {
            var words = label.split(' ');

            var line = "";

            for (var i = 0; i < words.length; i++) {

                if (line.length + words[i].length > maxChars) {
                    line = line.slice(0, -1);
                    lines.push(line);
                    line = "";                    
                }

                line += words[i] + " ";
            }

            line = line.slice(0, -1);
            lines.push(line);
        }

        return lines;
    }

    this.getX = function() {
        return x;
    }

    this.getY = function() {
        return y;
    }

    this.getWidth = function() {
        return width;
    }

    this.getHeight = function() {
        return height;
    }

    this.stroke = function(color) {
        clear();
        color = (typeof color !== "undefined") ? color : Canvas.getDefaultColor();
        Canvas.getContext().strokeStyle = color;
        Canvas.getContext().strokeRect(x, y, width, height);
        this.addText(color);
    }    

    this.resetText = function(labelToSet, color) {
        clear();
        label = (typeof labelToSet !== "undefined") ? labelToSet : "";
        this.addText(color);
    }

    this.addText = function(color) {

        var lines = getLabelLines();

        if (lines.length > 0) {

            Canvas.getContext().textAlign = align;
            Canvas.getContext().fillStyle = typeof color !== "undefined" ? color : Canvas.getDefaultColor();

            var centerX = (Canvas.getContext().textAlign == Canvas.getCenterAlign()) ? x + width / 2 : x;
            var centerY = y + height / 2;            

            var textHeight = Canvas.getTextHeight();

            var labelHeight = lines.length * textHeight;
            var lineY = centerY - labelHeight / 2 + textHeight / 2;  //нижняя граница первой строки

            for (var i = 0; i < lines.length; i++) {
                Canvas.getContext().fillText(lines[i], centerX, lineY + i * textHeight, width);
            }
        }        
    }

    /*function getRectOnPoint(rects, point) {	
        
        var result = -1;

        for (var i = 0; i < rects.length; i++) {
            if (rectContains(rects[i], point)) {
                result = i;
                break;
            }
        }

        return result;
    }*/

    this.containsPoint = function(point) {

        var result = false;	

        if (x <= point.x && point.x <= (x + width) && 
            y <= point.y && point.y <= (y + height)) {

            result = true;
        }
            
        return result;
    }

    this.toString = function() {
        var result = 
        "x = " + x +
        " y = " + y +
        " width = " + width + 
        " height = " + height;        
        return result;
    }

    this.log = function() {
        console.log(this.toString());
    }
}

Rect.getRectOnPoint = function(rects, point) {
    var result = -1;

    for (var i = 0; i < rects.length; i++) {
        if (rects[i].containsPoint(point)) {
            result = i;
            break;
        }
    }

    return result;
};