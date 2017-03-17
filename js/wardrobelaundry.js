/* this renders the images for wardrobe and pickoutfit. html */

$(document).ready(function () 
{
	var jsonURL = "php/clothinginfo.php";
	$.getJSON(jsonURL, function(json)
	{
		//$.each(json, function(key, value)
		for (var i=0; i < json.length; i++)
		{
			$('#' + json[i].clothesType + 'Div').append('<div class="responsive">\<div class="img"><img src="'+json[i].imgURL+'"/>\</div></div>' );
		};
	});
});

var imgURL;

$('img').click(function () 
{
	var imgURL = $(this).attr('src');
});

/* will this break anything? who knows.
$(document).ready(function ()
{
	$('#dvProd').append('<div class="responsive">\<div class="img"><img src="'+ imgURL + '" />\</div></div>' );
});
*/
