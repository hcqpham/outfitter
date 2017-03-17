/* this renders images only for pickoutfit.html & creates checklist*/



$(document).ready(function () 
{
	var jsonURL = "php/clothinginfo.php";
	$.getJSON(jsonURL, function(json)
	{
		//$.each(json, function(key, value)
		for (var i=0; i < json.length; i++)
		{
			$('#dvProdList').append('<div class="responsive">\<div class="img"><img src="'+json[i].imgURL+'"/>\</div></div>' );
		};
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



//btn dialogue
function successDialogue()
{
	document.getElementById("successbtn").innerHTML = "<br>Success!<br>";
}