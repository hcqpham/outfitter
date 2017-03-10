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
    //conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
  
    // set variables
    //$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
    //$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);
    //$imgURL="..img/uploaded/img_thumbnail.jpg"; //back to the whole uniq id situation
    $clothesType=$_POST['clothesType'];

    //upload image
    $handle = new upload($_FILES['image_field']);
    if ($handle->uploaded) 
    {
      $filename = uniqid('img_thumbnail'); // img_thumbnail5313950dafa39 
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
        $imgURL = "../img/uploaded/" + $filename + ".jpg";
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
    $statement = $conn->prepare("INSERT INTO clothesWardrobe(imgURL, clothesType) VALUES(?, ?)");
    $statement->bind_param("ss", $imgURL, $clothesType);
    $statement->execute();
  
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