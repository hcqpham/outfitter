<html>
  <head>
    <title>Outfitter - Wardrobe</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/stylesheet2.css" />

  </head>
  <body>

  <div id="wrapper">

        <!-- Header -->
          <header id="header">
            <div class="inner" id="gradpurp">

              <!-- title -->
                
                  <h2 style="color:white;">Uploading Image - Success!</h2>
                

              <!-- Nav -->
                <nav>
                  <ul>
                    <li><a href="#menu">Menu</a></li>
                  </ul>
                </nav>

            </div>
          </header>

        <!-- Menu -->
          <nav id="menu">
            <h2>Menu</h2>
                      <ul>
              <li><a href="../home.html">Home</a></li>
              <li><a href="../uploadimage.html">Add Clothes</a></li>
              <li><a href="../pickoutfit.html">Plan Outfits</a></li>
              <li><a href="../wardrobe.html">Wardrobe</a></li>
              <li><a href="../outfit.html">Outfits</a></li>
            </ul>
            </ul>
          </nav>

        <!-- Main -->
          <div id="main">
            <div class="inner">

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
        echo 'Image has successfully been uploaded and added to Your Wardobe!';
        echo '<br>Go back to <a href="../wardrobe.html">wardrobe</a>?';
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

  </div>


      </div>

    <!-- Scripts -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/skel.min.js"></script>
      <script src="../js/util.js"></script>
      <script src="../js/main.js"></script>
      <script src="../js/jquery.imgcheckbox.js"></script> <!-- loads checkbox on images-->
      <script src="../js/imageupload.js"></script>
      <script src="../js/weather.js"></script>     
      <script src="../js/pickoutfit.js"></script> 

<!-- script for weather. 3/2 for some reason my checkbox won't load at the same time as my weather api if this isn't commented out so i'm going to keep this here and not know what it really does becauase i like that it works -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script> -->
>

<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-92526850-2', 'auto');
 ga('send', 'pageview');

</script>

</body>
</html>