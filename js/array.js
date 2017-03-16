<!DOCTYPE html>
<html>
<body>

<p>Click the button to get every element in the array that has a value of 18 or more.</p>

<button onclick="myFunction()">Filter</button>

<script>
var ages = [32, 33, 16, 40];

// for (var i=0; i < json.length; i++)


function checkClothes(clothing) {
    return clothing.clothesType == dresses;
}

//figure out how to bring in types
//function checkTops, //function checkOuterweaaaar 
//since types of clothes aren't changing, i could do this fairly easily! 

function myFunction() {
    document.getElementById("demo").innerHTML = ages.filter(checkAdult);
}
</script>

<script>
$(document).ready(function () 
{
	var jsonURL = "php/clothinginfo.php";
	$.getJSON(jsonURL, function(json)
	{
		function checkClothes(clothing) {
	    return clothing.clothesType == dresses;
		}

		function myFunction() {
   		document.getElementById("demo").innerHTML = ages.filter(checkAdult);
		}
	}
}

</script>

</body>
</html>

need to use the . notation



