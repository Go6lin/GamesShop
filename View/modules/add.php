<?php

use Controller\productController;

require_once 'Controller/productController.php';

$productController = new productController();

?>
<div class="add">
        <h2>Расскажите про новую игру</h2>
    <form id="adder" class="add">
        <div class="settings">
            <div class="new-basic setting">
            <div class="new-name setting">
            <div class="new-name">
                <label for="new-name">Название:</label><br>
                <input name="new-name" class="new-name input" placeholder="Введите название">
            </div>
            </div>
            <div class="new-genres setting">
                <div class="new-genre">
                <label for="new-genre">Жанр:</label><br>
                <select name="new-genre" class="new-genre input">
                    <option></option>
                    <?php foreach ($productController->settingsTransfer()['variants'] as $variant) {
                        ?>
                        <option value="<?= $variant['name'] ?>"><?= $variant['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            </div>
            <div class="new-platforms setting">
                <div class="new-platform-box" id="select_platform">
                    <label for="new-platform">Платформа:</label><br>
                    <select name="new-platform" class="new-platform input" id="p_0">
                        <option></option>
                        <?php foreach ($productController->settingsTransfer()['sections'] as $section) {
                            ?>
                            <option value="<?= $section['notice'] ?>"><?= $section['notice'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="new-types setting">
                <div class="new-type-box" id="select_type">
                    <label for="new-type">Тип издания:</label><br>
                    <select name="new-type" class="new-type input" id="t_0">
                        <option></option>
                        <?php foreach ($productController->settingsTransfer()['types'] as $types) {
                            ?>
                            <option value="<?= $types['notice'] ?>"><?= $types['notice'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        </div>
        <div class="settings">
        <div class="new-price__new">
            <label for="new-price__new">Актуальная цена:</label><br>
            <input name="new-price__new" class="new-price__new input" placeholder="Введите цену">
        </div>
        <div class="new-price__old">
            <label for="new-price__old">Старая цена:</label><br>
            <input name="new-price__old" class="new-price__old input" placeholder="Введите цену">
        </div>
        <div class="new-currency setting">
            <div class="new-currency">
                <label for="new-currency">Валюта:</label><br>
                <select name="new-currency" class="new-currency input" placeholder="Введите цену">
                    <option></option>
                    <?php foreach ($productController->settingsTransfer()['currency'] as $currency) {
                        ?>
                        <option value="<?= $currency['name'] ?>"><?= $currency['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
        <div class="settings">
            <div class="new-annotation-announce setting">
            <div class="new-annotation-box">
                <label for="new-annotation">Кратко про игру:</label><br>
                <textarea name="new-annotation" class="new-annotation input" placeholder="Не более 300 символов"></textarea>
            </div>
            <div class="new-announce-box">
                <label for="new-announce">Подробная информация:</label><br>
                <textarea name="new-announce" class="new-announce" placeholder="До 1000 символов"></textarea>
            </div>
        </div>
        </div>
        <div class="settings">
        <div class="setting">
            <div class="form new-photo-box" id="new-photo">
                <label for="new-photo" class="label-new-photo">Фото</label><br>
                <input type="file" class="new-photo input" value="Загрузите фото" id="ph_0">
            </div>
        </div>
    </div>
        <button type="submit" id="adder" class="filter button">Добавить</button>
    </form>
</div>
