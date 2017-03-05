<?php
error_reporting(E_ALL);

// we first include the upload class, as we will need it here to deal with the uploaded file
include('class.upload.php');

// set variables

$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

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


    $handle->clean();
  } 
  else 
  {
    echo 'error : ' . $handle->error;
  }
}

?>