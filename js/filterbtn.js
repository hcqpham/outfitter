function filterBtn() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


$(document).ready(function(){
  $(".clothingType").click(function(e){
    e.preventDefault();
    var clothesType = $(this).data('val');
    //get all div elements within class clothes-container
    $("div.clothes-container>div").each(function(){
      var $this = $(this);
      if(clothesType == '' || $this.attr('id') == clothesType + "Div")
        $this.fadeIn();
      else
        $this.fadeOut();
    });
  });
});