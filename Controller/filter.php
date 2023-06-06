<?php

use Controller\productController;

require_once 'Controller/productController.php';

$productController = new productController();

$chekSettings = $productController->takeSettings();

if (empty($chekSettings)){
?>
<div class="box">
        <div class="fail__message">
            <h2>Ничего нет!</h2>
        </div>
        <?php
    } else {
        foreach ($productController->takeSettings() as $item) {
            ?>
            <div class="object">
                <div class="img">
                    <img src="View/img<?= $item['url'] ?>" class="img__main">
                </div>
                <div class="info">
                    <div class="name">
                        <h2><?= $item['name'] ?></h2>
                    </div>
                    <div class="price price-tag">
                        <div class="price__new">
                            <h3><?= $item['price'] . ' ' . $item['simbol'] ?></h3>
                        </div>
                        <div class="price__old">
                            <h4><?= $item['price_old'] ?></h4>
                        </div>
                    </div>
                    <div class="annotation">
                        <p><?= $item['notice'] ?></p>
                    </div>
                    <div class="details button">
                        <a href="../details.php?id=<?= $item[0] ?>">Подробнее</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>