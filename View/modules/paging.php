<?php

use Controller\productController;

require_once 'Controller/productController.php';

$page = $_GET['page'];
$newsController = new productController();
$idDivPage = 1;

?>
<div class="pages-list">
<?php
while ($idDivPage <= $newsController->paging()) {
    if ($idDivPage == $page) {
        $newsListObjectClass = "page__blue  $idDivPage";
    } else {
        $newsListObjectClass = "page $idDivPage";
    } ?>
    <div class="<?= $newsListObjectClass ?>">
        <a href="?page=<?= $idDivPage ?>"><?= $idDivPage ?></a>
    </div>
    <?php $idDivPage++;
}
?>
</div>
