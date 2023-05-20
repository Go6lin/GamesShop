<?php

use Controller\productController;

require_once 'Controller/productController.php';

$productController = new productController();

?>

<div class="settings">
    <form id="filter" class="form">
        <div class="platforms setting">
            <div class="form platform">
                <label for="platform" class="label-platform">Платформа:</label><br>
                <select name="platform" class="platform input">
                    <option>Любая платформа</option>
                    <?php foreach ($productController->settingsTransfer()['sections'] as $section) {
                        ?>
                        <option value="<?= $section['notice'] ?>"><?= $section['notice'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="genres setting">
            <div class="form genre">
                <label for="genre" class="label-genre">Жанр:</label><br>
                <select name="genre" class="genre input">
                    <option>Любой жанр</option>
                    <?php foreach ($productController->settingsTransfer()['variants'] as $variant) {
                        ?>
                        <option value="<?= $variant['name'] ?>"><?= $variant['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="currency setting">
            <div class="form currency">
                <label for="currency" class="label-currency">Валюта:</label><br>
                <select name="currency" class="currency input">
                    <option>Любая валюта</option>
                    <?php foreach ($productController->settingsTransfer()['currency'] as $currency) {
                        ?>
                        <option value="<?= $currency['name'] ?>"><?= $currency['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="price-setting setting">
            <div class="form price__min">
                <label for="price__min" class="label-price__min">Цена от:</label><br>
                <input name="price__min" class="price__min input" placeholder="От">
            </div>
        </div>
        <div class="price-setting setting">
            <div class="form price__max">
                <label for="price__max" class="label-price__max">Цена до:</label><br>
                <input name="price__max" class="price__max input" placeholder="До">
            </div>
        </div>
        <button type="submit"  class="filter button">Применить фильтры</button>
    </form>
</div>

