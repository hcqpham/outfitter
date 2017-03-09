<?php
error_reporting(E_ALL);

//include the upload class, as we will need it here to deal with the uploaded file
include('class.upload.php');

//set up mysql host
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "clothesDB"; 

// Opens connection to MySQL
try {
    $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }

// set variables
$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);
$imgURL=$_POST['imgURL'];
$clothesType=$_POST['clothesType'];

//upload image
$handle = new upload($_FILES['image_field']);
if ($handle->uploaded) {
  $handle->file_new_name_body   = 'image_thumbnail';
  $handle->image_convert = 'jpg';
  $handle->image_resize         = true;
  $handle->image_x              = 300;
  $handle->image_ratio_y        = true;
  $handle->process('../img/uploaded');
  
  if ($handle->processed) {
    echo 'Image being resized and successfully stored in uploaded img folder!';
    echo '<br>go back to <a href="../wardrobe.html">wardrobe</a>?';

    $handle->clean(); } 
  else {
    echo 'error : ' . $handle->error;
      }
  }

//executing the query and inserting into mysql db
$sql = "INSERT INTO clothesWardrobe(imgURL, clothesType)
VALUES('$imgURL', '$clothesType')";

//added condition if pass/fail
if(mysqli_affected_rows($connect)>0){
  echo "echo Success! <br>";
  echo "Go back to <a href="uploadimage.html">upload image</a> Or <a href="home.html">main menu</a>?";
}
else{
  echo "Adding to category NOT added. <br>";
  echo mysqli_error($connect);

//Catch block handles any problems that occur in DB queries
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

//Closes connection
    $conn = null;


?>