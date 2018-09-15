function MovieInfo(sel, title, year) {
    var that = this;

    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "4a9d4083d46e7ca6204f957b5bf8e1d4", query: title, year: year},
        method: "GET",
        dataType: "text",
        success: function (data) {
            var json = parse_json(data);
            if (json.total_results == 0) {
                $(".paper").html("<p>No information available</p>");
            } else {
                that.print(json.results[0], sel);
            }
        },
        error: function (xhr, status, error) {
            // An error!
            $(".paper").html("<p>Unable to connect</p>");
        }
    });
}

MovieInfo.prototype.print = function(result, sel){
    console.log(result);
    var html = "<ul><li id='info'><a href='#'><img src='images/info.png'></a><div class='show'>";
    html += "<p>Title: " + result['title'] + "</p>";
    html += "<p>Release Date: " + result['release_date'] + "</p>";
    html += "<p>Vote Average: " + result['vote_average'] + "</p>";
    html += "<p>Vote Count: " + result['vote_count'] + "</p>";
    html += "</div></li>";
    html += "<li id='plot'><a href='#'><img src='images/plot.png'></a><div>";
    html += "<p>" + result['overview'] + "</p>";
    html += "</div></li>";
    console.log(result['poster_path']);
    //if there is a poster, then add the poster tab
    if (result['poster_path'] != null) {
        html += "<li id='poster'><a href='#'><img src='images/poster.png'></a>";
        html += "<div><p class='poster'><img id='poster' src=''></p>";
        html += "</div></li>";
    }
    html += "</ul>";


    $(sel).html(html);

    //Get the link for the image
    $("img#poster").attr('src', 'http://image.tmdb.org/t/p/w500/' + result['poster_path']);

    $( document ).ready(function() {
        $("ul > li > a > img").css("opacity", 0.3);
        $("li#info > a > img").css("opacity", 1);
        //If info tab clicked
        $("li#info > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $( "li#info > a > img").css("opacity", 1);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#info > div").fadeIn(1000);
        });
        //If poster tab clicked
        $( "li#poster > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#poster > a > img").css("opacity", 1);
            $("li#info > div").fadeOut(1000);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeIn(1000);
        });
        //If plot tab clicked
        $( "li#plot > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#plot > a > img").css("opacity", 1);
            $("li#info > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#plot > div").fadeIn(1000);
        });
    });
};