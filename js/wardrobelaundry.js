/* this renders the images for wardrobe and laundry html */

$(document).ready(function () 
{
	var jsonURL = "php/scandir.php";
	$.getJSON(jsonURL, function(json)
	{
		$.each(json, function(key, value)
		{
			$('#dvProdList').append('<div class="responsive">\<div class="img"><img src="img/uploaded/' + value + '" />\</div></div>' );
		});
	});
});

var imgURL;

$('img').click(function () 
{
	var imgURL = $(this).attr('src');
});

$(document).ready(function ()
{
	$('#dvProd').append('<div class="responsive">\<div class="img"><img src="'+ imgURL + '" />\</div></div>' );
});

