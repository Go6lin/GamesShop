<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<!--<pre>-->
<?php
//print_r($_SERVER);
//?>
<!--   </pre>-->
<div class="enter">
    <?php require_once "View/modules/toAdd.php";?>
</div>
<div class="container">
    <div class="header">
        <h1>Cool Game Shop Name</h1>
    </div>
    <div class="corpus">
        <?php require_once "View/modules/productSettings.php";?>
        <?php require_once "View/modules/productList.php";?>

    </div>
    <div class="footer">
        <?php require_once "View/modules/paging.php";?>
    </div>

</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>