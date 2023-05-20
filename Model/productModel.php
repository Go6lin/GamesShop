<?php

namespace Model;

use PDO;
require_once "connect.php";

class productModel
{
    private $host = 'localhost'; //Host
    private $database = 'gameshop'; //Database name
    private $user = 'root'; //User name
    private $pass = 'root'; //Password
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8";
        $this->pdo = new PDO($dsn, $this->user, $this->pass);
    }

    public function getCount()
    {
        try {
            $sql = 'SELECT count(*) FROM product';
            $stmt = $this->pdo->query($sql);
            $count = $stmt->fetchColumn();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $count;
    }

    public function getSettings () {
        try {
            $sqlVariant = 'SELECT product_param_variant.name
                    FROM product_param_variant';
            $sqlSection = 'SELECT product_section.notice
                    FROM product_section';
            $sqlCurrency = 'SELECT currency.name
                    FROM currency';
            $sqlTypes = 'SELECT product_type.notice
                    FROM product_type';
            $stmtVariant = $this->pdo->query($sqlVariant);
            $stmtSection = $this->pdo->query($sqlSection);
            $stmtCurrency = $this->pdo->query($sqlCurrency);
            $stmtTypes = $this->pdo->query($sqlTypes);
            $variants  = $stmtVariant->fetchAll();
            $sections = $stmtSection->fetchAll();
            $currency = $stmtCurrency->fetchAll();
            $types = $stmtTypes->fetchAll();
            $settings = ['variants' => $variants, 'sections' => $sections, 'currency' => $currency, 'types' => $types];
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $settings;
    }

    public function getSeveral($filter)
    {
       if(gettype($filter) == 'integer'){
        try {
            $sqlProduct = 'SELECT product.id, product.name, product.price, product.price_old, product.notice,
                                  product_images.url,
                                  currency.simbol
                            FROM product
                            INNER JOIN product_images ON product.id = product_images.product_id
                            INNER JOIN currency ON product.currency_id = currency.id
                            WHERE product_images.url
                            LIKE "%1.jpg" LIMIT ' . $filter . ', 3';
            $stmt = $this->pdo->query($sqlProduct);
            $severalGames = $stmt->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    } else {
           $query = [];
           if ($filter['platform'] !== 'Любая платформа') {
               array_push($query,"product_section.notice = '" .$filter['platform'] . "'");
           }
           if ($filter['genre'] !== 'Любой жанр') {
               array_push($query, "product_param_variant.name = '" .$filter['genre'] . "'");
           }
           if ($filter['currency'] !== 'Любая валюта') {
               array_push($query,"currency.name = '" .$filter['currency'] . "'" );
           }
           if ($filter['price__min'] !== '' && $filter['price__max'] !== '') {
               array_push($query, "product.price BETWEEN '" .$filter['price__min'] . "' AND '" .$filter['price__max'] . "'" );
           }
           elseif ($filter['price__min'] !== '' && $filter['price__max'] == '') {
               array_push($query, "product.price >'" .$filter['price__min'] . "'");
           }
           elseif ($filter['price__max'] !== '' && $filter['price__min'] == '') {
               array_push($query, "product.price <'" .$filter['price__max'] . "'");
           }

           $i = 0;
           $readyQuery = "WHERE ";
           while ($i <= count($query)) {
               if (empty($query)) {
                   $readyQuery = $readyQuery . " product_images.url LIKE '%1.jpg'";
                   break;
               }
               if ($i == count($query)) {
                   $readyQuery = $readyQuery ." AND product_images.url LIKE '%1.jpg'";
                   break;
               }
               if ($i > 0) {
                   $readyQuery = $readyQuery . " AND " . $query[$i];

               } else {
                   $readyQuery = $readyQuery . $query[$i];
               }
               $i++;
           }
           try {
               $sqlProduct = "SELECT DISTINCT product.id, product.name, product.price, product.price_old, product.notice,
                                  product_images.url,
                                  currency.simbol
                            FROM product
                            INNER JOIN product_images ON product.id = product_images.product_id
                            INNER JOIN currency ON product.currency_id = currency.id
                            INNER JOIN product_assignment ON product.id = product_assignment.product_id
                            INNER JOIN product_section ON product_assignment.section_id = product_section.id
                            INNER JOIN product_param_assignment ON product.id = product_param_assignment.product_id
                            INNER JOIN product_param_name ON product_param_assignment.param_name_id = product_param_name.id  
                            INNER JOIN product_param_variant ON product_param_assignment.variant_id = product_param_variant.id
                            ".$readyQuery;
               $stmt = $this->pdo->query($sqlProduct);
               $severalGames = $stmt->fetchAll();
           } catch (PDOException $e) {
               die($e->getMessage());
           }
       }
        return $severalGames;
    }

    public function getOne($productId)
    {
        try {
            $sql = 'SELECT product.name, product.price, product.price_old, product.content,
                           currency.name, currency.simbol,
                           product_param_variant.name,
                           product_section.url, product_section.name, product_section.notice,
                           product_type.url, product_type.name, product_type.notice, product_type.coef
                    FROM product  
                    INNER JOIN currency ON product.currency_id = currency.id
                    INNER JOIN product_assignment ON product.id = product_assignment.product_id
                    INNER JOIN product_section ON product_assignment.section_id = product_section.id
                    INNER JOIN product_type ON product_assignment.type_id = product_type.id    
                    INNER JOIN product_param_assignment ON product.id = product_param_assignment.product_id
                    INNER JOIN product_param_name ON product_param_assignment.param_name_id = product_param_name.id  
                    INNER JOIN product_param_variant ON product_param_assignment.variant_id = product_param_variant.id
                    WHERE product.id=' . $productId;
            $sqlImg = 'SELECT product_images.url FROM product_images WHERE product_images.product_id='. $productId;
            $stmtBasic = $this->pdo->query($sql);
            $stmtImg = $this->pdo->query($sqlImg);
            $basic = $stmtBasic->fetchAll();
            $img = $stmtImg->fetchAll();
            $oneGame = ['basic' => $basic, 'img' => $img];
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $oneGame;
    }

    public function addNew ($arr) {
//        $name = $arr['name'];
//        $genre = $arr['genre'];
//        $platform = $arr['platform'];
//        $type = $arr['type'];
//        $currency = $arr['currency'];
//        $price__min = $arr['price__min'];
//        $price__max = $arr['price__max'];
//        $annotation = $arr['annotation'];
//        $announce = $arr['announce'];
        $name = $arr['name'];
        $genre = $arr['genre'];
        $platform = $arr['platform'];
        $type = $arr['type'];
        $currency = $arr['currency'];
        $price__min = $arr['price__min'];
        $price__max = $arr['price__max'];
        $annotation = $arr['annotation'];
        $announce = $arr['announce'];
        $position = 1;
        $url = 'aaa';
        $articul = 1;
        $visible = 1;
        if ($currency = 'RUB') {$currency = 1;}
        elseif ($currency = 'USD') {$currency = 2;}
        elseif ($currency = 'EUR') {$currency = 3;}
        else {$currency = 4;}
        try {
            $sql = "INSERT INTO product (position, url, name, articul, price, currency_id, price_old, notice, content, visible)
                VALUES ('$position', '$url', '$name', '$articul', '$price__min', '$currency', '$price__max', '$annotation', '$announce', '$visible')";
            $this->pdo->exec($sql);
            print_r("adad");
        } catch (PDOException $e) {echo  $e->getMessage();}
    }
}