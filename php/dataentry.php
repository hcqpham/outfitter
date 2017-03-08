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

/* 
-- Insert Data
Q: if i'd like for this data to be dynamically submitted, how should i go about doing this? 
*st: a front end form would need to POST some data to this script. you can then read this data through the $_POST superglobal and do what you want with it.
*/

//Catch block handles any problems that occur in DB queries
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

//Closes connection
    $conn = null;

?>