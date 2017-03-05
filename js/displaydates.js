//shows the calendar counter on the home page.

function display_date() 
{
	var today = new Date();
  var days = [ "Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat" ];
  for (i = 0; i < 7; i++) {
		document.getElementById("date" + i).innerHTML = today.getDate() + i;
		document.getElementById("day" + i).innerHTML = days[(today.getDay() + i) % 7];
  }
}

display_date();