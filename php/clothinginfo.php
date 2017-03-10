<?php 

//set up mysql host
$servername = "localhost";
$username = "clothes";
$password = "clothes";
$dbname = "clothesDB"; 

// Opens connection to MySQL
  $conn = new mysqli($servername, $username, $password, $dbname);
  //selecting clothesID column, substring imgURL, 4 starting from the fourth character as imgURL column alias in json 
	$sql = "select ClothesID, substr(imgURL, 4) as imgURL, clothesType from clothesWardrobe;"; 
	$statement = $conn->prepare($sql); 

header("Content-Type: application/json");

echo json_encode(stmt_fetch_assoc($statement));

/*
$directory = '../img/uploaded';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));


echo json_encode($scanned_directory);

$myfile = fopen("../js/uploadedimgarray.json", "w") or die("Unable to open file!");
$txt = json_encode($scanned_directory);
fwrite($myfile, $txt);
fclose($myfile);
*/

function stmt_fetch_assoc($statement) //select *from clothesWardrobe
{
        $statement->execute();
        $array = array();
        $statement->store_result();

        $variables = array();
        $data = array();
        $meta = $statement->result_metadata();

        while($field = $meta->fetch_field())
                $variables[] = &$data[$field->name]; // pass by reference

        call_user_func_array(array($statement, 'bind_result'), $variables);

        $i=0;
        while($statement->fetch())
        {
                $array[$i] = array();
                foreach($data as $k=>$v)
                        $array[$i][$k] = $v;
                $i++;

                // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
        }
        $statement->close();
        return $array;
}
?>
