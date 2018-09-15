function Enigma(sel) {
    var form = $(sel);
    var enigma = $(sel + " div"); //enigma div class

    var lights = enigma.find("div.light"); //light div class
    var keys = enigma.find("div.key"); //key div class (the buttons that turn red)
    var w1 = enigma.find("p.wheel.wheel-1");
    var w2 = enigma.find("p.wheel.wheel-2");
    var w3 = enigma.find("p.wheel.wheel-3");

    //install listeners on each key
    for(var k=0; k<keys.length; k++) {
        var key = $(keys.get(k)); //key object

        // We are at a key
        this.installListener(keys, key, lights, w1, w2, w3);
    }

    form.submit(function(event) {
        event.preventDefault();

        console.log("Reset");
        $.ajax({
            url: "post/newpost.php",
            data: {reset: true},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                console.log(json.reset);
                w1.text(json.one);
                w2.text(json.two);
                w3.text(json.three);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
}

Enigma.prototype.installListener = function(keys, key, lights, w1, w2, w3) {
    var that = this;
    var key_letter = key.text(); //actual key letter

    key.mousedown(function(){
        that.addClass(keys, key);

        $.ajax({
            url: "post/newpost.php",
            data: {key: key_letter},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                w1.text(json.one);
                w2.text(json.two);
                w3.text(json.three);
                that.removeClassLight(lights);
                that.addClassLight(lights, json.light);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

    });

    key.mouseup(function(){
        that.removeClass(keys);
    });

    key.click(function() {
        console.log("Click on " + key_letter);
        event.preventDefault();

    });
}

Enigma.prototype.removeClass = function(keys) {
    var that = this;

    for(var k=0; k<keys.length; k++) {
        var key = $(keys.get(k)); //key object
        var key_letter = key.text().toLowerCase(); //actual key letter (lowercase)
        key.attr("class", "key key-" + key_letter);
    }
}

Enigma.prototype.addClass = function(keys, key) {
    var that = this;
    that.removeClass(keys); //removes class from every key

    var key_letter = key.text().toLowerCase(); //actual key letter (lowercase)
    key.attr("class", "key key-" + key_letter + " pressed");
}

Enigma.prototype.removeClassLight = function(lights) {
    var that = this;
    for(var l=0; l<lights.length; l++) {
        var light = $(lights.get(l)); //key object
        var light_letter = light.text().toLowerCase(); //actual key letter (lowercase)
        light.attr("class", "light light-" + light_letter);
    }
}

Enigma.prototype.addClassLight = function(lights, light) {
    var that = this;

    for(var l=0; l<lights.length; l++) {
        var xlight = $(lights.get(l)); //key object
        var xlight_letter = xlight.text();
        if(xlight_letter == light) {
            var yipee = xlight;
        }
    }

    var light_letter = light.toLowerCase(); //actual key letter (lowercase)
    yipee.attr("class", "light light-" + light_letter + " light-on");
}

