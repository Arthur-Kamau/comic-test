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
<div class="row">
<div class="col-lg-7">
<table class="table ">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">modified</th>
    </tr>
    </thead>
    <tbody>
<?php
error_clear_last();
$cache= dirname(__FILE__).'/cache/caracters.json';
$json="";
if(file_exists($cache)){
    $string = file_get_contents($cache);

    $json = json_decode($string, true);
//    die("file exists ");
}else {
    // get data from api
    $json = getData("https://gateway.marvel.com:443/v1/public/characters");

// write cache
    $fh = fopen($cache, 'w+');
    if (!$fh) {
        die("error opening cache " . var_dump(error_get_last()));

    } else {
        fwrite($fh, json_encode($json));
        fclose($fh);
        chmod($cache, 0777);
    }
}
for ($i = 1; $i <= count($json["data"]["results"]); $i++) {

    $item = $json["data"]["results"][$i];

    ?>
<tr>
    <th ><?= $i ?></th>
    <td><?php print_r($item["id"])  ?></td>
    <td><?php print_r( $item["name"])  ?></td>
    <td><?php print_r($item["modified"])  ?></td>

</tr>


    <?php
}

?>
    </tbody>
</table>
</div>
</div>
</body>
</html>
