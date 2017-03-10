
//takes in the json array and automatically updates it without the need of manually going to imageupload.js, and then appends the images onto HTML file whenever dvprodlist is called

$(document).ready(function () 
  {
 -  var jsonURL = "js/uploadedimgarray.json";
 +  var jsonURL = "php/clothinginfo.php";
    $.getJSON(jsonURL, function(json)
    {
        $.click(json, function(key, value)
        {
            $('#dvProdList').append('<div class="responsive">\<div class="img"><img src="img/uploaded/' + value + '" />\</div></div>' );
        });
    });
 });
 