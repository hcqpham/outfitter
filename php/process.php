<?php include='insert.php';> //don't even know if i'm inserting my BD right
//Goal: Display the submitted data from sortclothes? Or to insert the data from form into MySQL database

<?php

//creating variables
// $imgURL=$_POST['imgURL']; commenting out bc unsure whether or not this is right
$clothesType=$_POST['clothesType'];

//executing the query and inserting into mysql db
mysqli_query($connect"INSERT INTO clothesWardrobe(imgURL,clothesType)
						VALUES('$imgURL',$clothesType')");

//added condition
if(mysqli_affected_rows($connect)>0){
	echo "echo Success! <br>";
	echo "Go back to <a href="uploadimage.html">upload image</a> Or <a href="home.html">main menu</a>?";
}
else{
	echo "Adding to category NOT added. <br>";
	echo mysqli_error($connect);
}

?>