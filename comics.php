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
    <title>Comics</title>
</head>
<?php
importCDNs()
?>
<body>
<h4>Fetch Comics</h4>
<div class="row">
    <div class="col-lg-7">
        <table class="table ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">Issue Number</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $json= getData("https://gateway.marvel.com:443/v1/public/comics");
            //print_r($json);

            for ($i =1; $i <= count($json["data"]["results"]); $i++) {

                $item = $json["data"]["results"][$i];

                ?>
                <tr>
                    <th ><?= print_r($i );?></th>
                    <th ><?= print_r($item["title"]) ;?></th>
                    <th ><?= print_r($item["issueNumber"]) ?></th>


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
