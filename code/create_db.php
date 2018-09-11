<?php
 $servername = "localhost";
$username = "root";
$password = "mysql";
@@ -13,13 +14,12 @@
// Create database
$sql = "CREATE DATABASE IF NOT EXISTS Crawler";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
    echo "Database created successfully".'<br>';
} else {
    echo "Error creating database: " . $conn->error;
    echo "Error creating database: ". $conn->error.'<br>';
}
 $conn->select_db("Crawler");
 // sql to create table
$sql = "CREATE TABLE IF NOT EXISTS SitesViewed (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
@@ -28,11 +28,10 @@
)";
 if (mysqli_query($conn, $sql)) {
    echo "Table SitesViewed created successfully";
    echo "Table SitesViewed created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn);
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}
 // sql to create table
$sql = "CREATE TABLE IF NOT EXISTS SitesAwaiting (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
@@ -41,31 +40,28 @@
)";
 if (mysqli_query($conn, $sql)) {
    echo "Table SitesAwaiting created successfully";
    echo "Table SitesAwaiting created successfully".'<br>';
} else {
    echo "Error creating table: " . mysqli_error($conn);
    echo "Error creating table: " . mysqli_error($conn).'<br>';
}
 $result = mysqli_query($conn, "SHOW COLUMNS FROM `SitesViewed` LIKE 'content'");
$exists = (mysqli_num_rows($result)) ? TRUE:FALSE;
 if (!$exists) {
    // sql to ALTER table
    $sql = "ALTER TABLE SitesViewed ADD content TEXT after site";
     if (mysqli_query($conn, $sql)) {
        echo "ALTER TABLE SitesViewed successfully";
        echo "ALTER TABLE SitesViewed successfully".'<br>';
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
        echo "Error creating table: " . mysqli_error($conn).'<br>';
    }  
    // sql to ALTER table
    $sql = "ALTER TABLE SitesViewed MODIFY site VARCHAR(2048)";
    if (mysqli_query($conn, $sql)) {
        echo "ALTER TABLE SitesViewed successfully";
        echo "ALTER TABLE SitesViewed successfully".'<br>';
    } else {
        echo "Error creating table: " . mysqli_error($conn);
        echo "Error creating table: " . mysqli_error($conn).'<br>';
    }
}

$conn->close();

?>
