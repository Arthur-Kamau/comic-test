<?php
include_once('util.php');
/**
 * Author: kenn  kamau
 * Website: https://github.com/Arthur-Kamau
 * Purpose: Example to query Marvel API using PHP and responsive webpage
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
    importCDNs()
    ?>
</head>
<body>

<?php
if(!function_exists('curl_exec')) {
    die("NO CURL detected for this test to work ensure you install curl in php");
}
?>

<div class="container">
    <h1>Test the following implemented actions</h1>
    <div class="row">
    <div class="col-lg-6">
        <ul class="list-group">
            <li class="list-group-item "><a href="characaters.php">Characters (with cache)</a></li>
            <li class="list-group-item"><a href="comics.php">Comics (without cache)</a></li>
            <li class="list-group-item"><a href="upload.php">Form Upload</a></li>

        </ul>
    </div>
</div>

    <small>Dissatisfied  or want more items implemented get back to me @ kennkamau09@gmail.com  thanks. </small>
</div>
</body>
</html>


