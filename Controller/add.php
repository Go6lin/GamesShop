<?php
use Controller\productController;

require_once 'productController.php';

$productController = new Controller\productController();

$name = $_POST['new-name'];
$genre = $_POST['new-genre'];
$platform = $_POST['new-platform'];
$type = $_POST['new-type'];
$currency = $_POST['new-currency'];
$price__min = $_POST['new-price__min'];
$price__max = $_POST['new-price__max'];
$annotation = $_POST['new-annotation'];
$announce = $_POST['new-announce'];
$arr = [$name, $genre, $platform, $type, $currency, $price__min, $price__max, $annotation, $announce];
print_r($arr);


//$arr = ['name' => $_POST['new-name'], 'genre' => $_POST['new-genre'], 'platform' => $_POST['new-platform'],
//    'type' => $_POST['new-type'], 'currency' => $_POST['new-currency'] ,'price__min' => $_POST['new-price__min'],
//    'price__max' => $_POST['new-price__max'], 'annotation' => $_POST['new-annotation'], 'announce  ' => $_POST['new-announce']];

$productController -> takeNew ($arr);