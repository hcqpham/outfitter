<?php
error_reporting(E_ALL);

//include the upload class, as we will need it here to deal with the uploaded file
include('class.upload.php');

//set up mysql host
$servername = "localhost";
$username = "clothes";
$password = "clothes";
$dbname = "clothesDB"; 

// Opens connection to MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
  
    // set variables
    $clothesType=$_POST['clothesType'];

    //upload image
    $handle = new upload($_FILES['image_field']);
    if ($handle->uploaded) 
    {
      $filename = uniqid('img_thumbnail'); // will appear as img_thumbnail5313950dafa39 
      $handle->file_new_name_body   = $filename;
      $handle->image_convert = 'jpg';
      $handle->image_resize         = true;
      $handle->image_x              = 300;
      $handle->image_ratio_y        = true;
      $handle->process('../img/uploaded');
  
      if ($handle->processed) 
      {
        echo 'Image being resized and successfully stored in uploaded img folder!';
        echo '<br>go back to <a href="../wardrobe.html">wardrobe</a>?';
        $imgURL = "../img/uploaded/".$filename.".jpg";
        $statement = $conn->prepare("INSERT INTO clothesWardrobe(imgURL, clothesType) VALUES(?, ?)");
        $statement->bind_param("ss", $imgURL, $clothesType);
        $statement->execute();
        $handle->clean(); 
      }
    }
    else 
    {
      echo 'error : ' . $handle->error;
    }

    //executing the query and inserting into mysql db
   /*  THIS IS BAD - SQL INJECTION CAN OCCUR HERE AND YOU WILL REGRET IT IF IT HAPPENS. AVOID. Make prepared statements!
    $sql = "INSERT INTO clothesWardrobe(imgURL, clothesType) VALUES('$imgURL', '$clothesType')"; */
    
  
    // mysqli connection if pass/fail
/*      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
*/

//Closes connection
  $conn->close();

?>