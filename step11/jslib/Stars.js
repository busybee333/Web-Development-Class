function Stars(sel) {
    var that = this;
    this.sel = sel;

    var table = $(sel + " table");  // The table tag
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(row, star, id, s+1);
        }
    }
}

Stars.prototype.installListener = function(row, star, id, rating) {
    var that = this;

    star.click(function() {
        console.log("Click on " + id + " rating: " + rating);
        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Successfully updated
                    that.update(row, rating, json.table);
                    that.message("<p>Successfully updated</p>");
                    new Stars(that.sel);
                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");

                }
            },
            error: function(xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");
            }
        });
    });
}

Stars.prototype.update = function(row, rating, table) {
    var that = this;
    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));

        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }
}

    var num = row.find("span.num");
    num.text("" + rating + "/10");
    $('table').html(table);
}

Stars.prototype.message = function(message) {
    console.log("hello");
    // do something...
    //make the message appear for two seconds,
    //then fade out over one additional second
    $('.message').html(message).show().delay(2000);
    $('.message').fadeOut(1000);

}