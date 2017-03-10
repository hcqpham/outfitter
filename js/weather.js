/* Sample function - not called */
function getWeatherDemo() {
    $.get('https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast ' +
          'where woeid in (select woeid from geo.places(1) where text="London")&format=json', function (data) {
        console.log(data);
        alert("The temperatute in London is " +
            data.query.results.channel.item.condition.temp +
            data.query.results.channel.units.temperature
        );
    });
}

function getWeather() {
    var location = $('#city').val();

    $.get('https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="' + location + '")&format=json', function (data) {
        /* Check that a place was found (we'll just grab the first) */
        if (data.query.results === null) {
            bootbox.alert("LOCATION NOT FOUND: Please try searching for your city again. Is this correct? " + location);

        } else {
            $('.jumbotron').html('<h2>' + data.query.results.channel.item.title + '</h2>' +
                data.query.results.channel.item.description)
            $('.container').show();
        }

    });
}

$("#hidebtn").click(function(){
    $(".jumbotron").hide();
});

$("#showbtn").click(function(){
    $(".jumbotron").show();
});


//i'm also adding the hide and show buttons here because yes, my code is shit and yes, this is an unorganized clusterfuck. i'm sorry.
$("#hidebtn").click(function(){
    $(".firsttimer").hide();
});

$("#showbtn").click(function(){
    $(".firsttimer").show();
});