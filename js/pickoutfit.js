/* this renders images only for pickoutfit.html & creates checklist*/



$(document).ready(function () 
{
	var jsonURL = "php/clothinginfo.php";
	$.getJSON(jsonURL, function(json)
	{
		$.each(json, function(key, value)
		{
			$('#dvProdList').append('<div class="responsive">\<div class="img"><img src="img/uploaded/' + value + '" />\</div></div>' );
		});
			//get all elements w/ class .img in element w/ #dvprodlist
			$("#dvProdlist img").imgCheckbox();
			$("#dvProdlist img").select();
			$("#dvProdlist img").deselect();
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

//btn dialogue
function successDialogue()
{
	document.getElementById("successbtn").innerHTML = "<br>Success!<br> Do you want to <a href='pickoutfit.html'>pick another outfit?</a><br><br>Or see <a href='outfit.html'>Outfits</a>";
}