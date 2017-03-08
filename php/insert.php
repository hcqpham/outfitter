<?php

$servername = "clairepham.com";
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

//Insert Data
/* 3/8 Q: if i want imgURL to be added to the same clothesID as clothesType, how would i do that? per our conversation yesterday, you recommended against having one php file that would handle all of this. should i have scandir.php for example render this page right after?  */
$sql="INSERT INTO clothesWardrobe (clothesType)
	VALUES('$_POST[fname]')
";

if(!mysql_query($sql, $conn))
{
	die('Error: ' .mysql_error());
}

/*
3/8 notes. for future reference, user friendly language should appear something like: Success! Go back to upload image? Or main menu? should i echo a success msg in insert.php or process.php?

Other notes: Pages should be able to load without having to refresh. Work on ajax tonight. 

echo "Success! <br>;
echo "Go back to <a href='uploadimage.html'>upload image</a>? Or <a href='home.html'>main menu</a>?";
*/


//Catch block handles any problems that occur in DB queries
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

//Closes connection
    $conn = null;

?>