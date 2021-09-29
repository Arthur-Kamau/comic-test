<?php
include_once('util.php');
/**
 * Author: kenn  kamau
 * Website: https://github.com/Arthur-Kamau
 * Purpose: upload csv and insert into database efficiently
 *
 * ensure to update your php.ini file for large file
 */


if (isset($_FILES['item'])) {


    $errors = array();
    $file_name = $_FILES['item']['name'];
    $file_size = $_FILES['item']['size'];
    $file_tmp = $_FILES['item']['tmp_name'];
    $file_type = $_FILES['item']['type'];

    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if ($file_ext == "csv") {


        if (file_exists($file_tmp)) {


            $servername = "localhost";
            $username = "kamau";
            $password = "@KennKamau09";

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                die("Database Connection failed: " . $conn->connect_error);
            }

            // check if database exist
            $db = $conn->select_db("test_project_db");
            if (!$db) {
                // Create database
                $sql = "CREATE DATABASE test_project_db ;";
                if ($conn->query($sql) === TRUE) {

                    //connect to db
                    $conn->select_db("test_project_db");
                    // create table
                    $sql = "CREATE TABLE CSVDATA (
                                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                a VARCHAR(15)  NOT NULL,
                                b VARCHAR(50) NOT NULL,
                                c TEXT NOT NULL,
                                d VARCHAR(10)  NOT NULL,
                                e VARCHAR(50) NOT NULL,
                                f VARCHAR(50) NOT NULL,
                                g VARCHAR(50) NOT NULL,
                                h VARCHAR(500) NOT NULL,
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                            )";

                    if ($conn->query($sql) === FALSE) {

                        echo "Error creating table: " . $conn->error;
                    }

                }else{
                    echo "Error creating database: " . $conn->error;
                }
            }



                // Read a CSV file
                $handle = fopen($file_tmp, "r");

                // the loop its currently iterating over
                $lineNumber = 1;

                // Iterate over every line of the file
                while (($raw_string = fgets($handle)) !== false) {
                    // Parse the raw csv string: "1, a, b, c"
                    $row = str_getcsv($raw_string);


                    $sql = "INSERT INTO CSVDATA (a, b, c,d,e,f,g,h)
                            VALUES (
                                    '" . $row["0"] . "',
                                     '" . $row["1"] . "', 
                                     '" . $conn ->escape_string( $row["2"]) . "',
                                     ' " . $row["3"] . "',
                                      '" . $row["4"] . "', 
                                      '" . $row["5"] . "',
                                      '" . $row["6"] . "',
                                      '" . $row["7"] . "')";


                    if ($conn->query($sql) === FALSE) {

                        die( "Error: " . $sql . "<br>" . $conn->error);
                    }
                    // Increase the current line
                    $lineNumber++;
                }



                fclose($handle);


                $conn->close();

        } else {
            die("file does not exist path");
        }
    } else {
        die("Only csv file is allowed " . $file_ext);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
    <?php
    importCDNs()
    ?>
</head>
<body>

<div class="container">
    <form class="col-lg-4" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileFormControlInput1">Select csv file to upload</label>
            <input type="file" name="item" class="form-control" id="fileFormControlInput1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
